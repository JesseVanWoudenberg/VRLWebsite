<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequests\StoreTeamTransferRequestRequest;
use App\Http\Requests\DriverRequests\UpdateTeamTransferRequestRequest;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\RequestStatus;
use App\Models\Requests\TeamTransferRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

;

class TeamTransferRequestController extends Controller
{
    public function create(): View
    {
        User::checkIfValidDriver();

        $teams = Team::all();

        return view('driver.requests.teamtransfer.create', compact(['teams']));
    }

    public function show(int $id)
    {
        User::checkIfValidDriver();

        $teamTransferRequest = TeamTransferRequest::all()->where('id', '=', $id)->first();

        if ($teamTransferRequest->request_status_id == RequestStatus::all()->where('status', '=', 'Denied')->first()->id)
        {
            return view('driver.requests.teamtransfer.show', compact('teamTransferRequest'));
        }
        else
        {
            abort(403);
        }
    }

    public function store(StoreTeamTransferRequestRequest $request)
    {
        User::checkIfValidDriver();

        if (TeamTransferRequest::all()->where('user_id', '=', Auth::id())->where('request_status_id', '=', RequestStatus::all()->where('status', '=', 'Opened')->first()->id)->count() > 0)
        {
            return redirect()->route('driverpanel.requests')->withErrors(['msg' => 'You already have an open drivernumber change request']);
        }

        $newRequest = new TeamTransferRequest();
        $newRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Opened')->first()->id;
        $newRequest->user_id = Auth::id();
        $newRequest->driver_id = Auth::user()->driver->id;
        $newRequest->team_id = $request->team_id;
        $newRequest->reason = $request->reason;

        $newRequest->save();

        return redirect()->route('driverpanel.requests')->with("Request successfully sent");
    }

    public function edit(TeamTransferRequest $teamTransferRequest)
    {
        User::checkIfValidDriver();
    }

    public function update(UpdateTeamTransferRequestRequest $request, TeamTransferRequest $teamTransferRequest)
    {
        User::checkIfValidDriver();
    }

    public function delete(int $teamtransferRequestId): View
    {
        User::checkIfValidDriver();

        $teamtransferRequest = Teamtransferrequest::all()->where('id', '=', $teamtransferRequestId)->first();

        return view('driver.requests.teamtransfer.delete', compact('teamtransferRequest'));
    }

    public function destroy(int $teamtransferRequest): RedirectResponse
    {
        User::checkIfValidDriver();

        Teamtransferrequest::all()->where('id', '=', $teamtransferRequest)->first()->delete();

        return redirect()->route('driverpanel.requests')->with("Request cancelled");
    }
}
