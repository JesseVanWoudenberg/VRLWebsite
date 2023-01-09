<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\DrivernumberChangeRequestDenyReason;
use App\Models\Requests\RequestStatus;
use App\Models\Requests\TeamTransferRequest;
use App\Models\Requests\TeamTransferRequestDenyReason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        $drivernumberChangeRequests = DrivernumberChangeRequest::query()
            ->select("*")
            ->whereIn('drivernumber_change_requests.request_status_id', (function ($query) {
                $query->from('request_statuses')
                    ->select('request_statuses.id')
                    ->where('status', 'Opened')
                    ->orWhere('status', 'Returned');
            }))->orderByDesc('drivernumber_change_requests.updated_at')->get();

        $teamTransferRequests = TeamTransferRequest::query()
            ->select("*")
            ->whereIn('team_transfer_requests.request_status_id', (function ($query) {
                $query->from('request_statuses')
                    ->select('request_statuses.id')
                    ->where('status', 'Opened')
                    ->orWhere('status', 'Returned');
            }))->orderByDesc('team_transfer_requests.updated_at')->get();

        return view('private.request.index', compact('drivernumberChangeRequests', 'teamTransferRequests'));
    }

    public function handleDrivernumberChangeRequest(int $id): View
    {
        $drivernumberChangeRequest = DrivernumberChangeRequest::all()->where('id', '=', $id)->first();

        return view('private.request.drivernumber.handle', compact('drivernumberChangeRequest'));
    }

    public function handleDriverNumberChangeRequestDecision(Request $request, int $id): RedirectResponse
    {
        $drivernumberChangeRequest = DrivernumberChangeRequest::all()->where('id', '=', $id)->first();

        if ($request->decision == 'Accept')
        {
            $driver = Driver::all()->where('id', '=', $drivernumberChangeRequest->driver_id)->first();
            $driver->drivernumber = $drivernumberChangeRequest->new_drivernumber;
            $driver->save();

            $drivernumberChangeRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Accepted')->first()->id;
        }
        else if ($request->decision == 'Deny')
        {
            $drivernumberChangeRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Denied')->first()->id;

            $reason = new DrivernumberChangeRequestDenyReason();

            $reason->drivernumber_change_request_id = $drivernumberChangeRequest->id;
            $reason->reason = $request->input('reason');

            $reason->save();
        }

        $drivernumberChangeRequest->save();

        return redirect()->route('admin.requests');
    }

    public function handleTeamTransferRequest(int $id): View
    {
        $teamTransferRequest = TeamTransferRequest::all()->where('id', '=', $id)->first();

        return view('private.request.teamtransfer.handle', compact('teamTransferRequest'));
    }

    public function handleTeamTransferRequestDecision(Request $request, int $id): RedirectResponse
    {
        $teamTransferRequest = TeamTransferRequest::all()->where('id', '=', $id)->first();

        if ($request->decision == 'Accept')
        {
            if ($teamTransferRequest->team->name != 'Reserves' && $teamTransferRequest->team->name != 'None') {
                if (Driver::all()->where('tier_id', '=', $teamTransferRequest->driver->tier_id)->count() >= 2) {
                    return redirect()->route('admin.requests')->withErrors(['msg' => 'Team already has 2 drivers']);
                }
            }

            $driver = Driver::all()->where('id', '=', $teamTransferRequest->driver_id)->first();
            $driver->team_id = $teamTransferRequest->team_id;
            $driver->save();

            $teamTransferRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Accepted')->first()->id;
        }
        else if ($request->decision == 'Deny')
        {
            $teamTransferRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Denied')->first()->id;

            $reason = new TeamTransferRequestDenyReason();

            $reason->team_transfer_request_id = $teamTransferRequest->id;
            $reason->reason = $request->input('reason');

            $reason->save();
        }

        $teamTransferRequest->save();

        return redirect()->route('admin.requests');
    }
}
