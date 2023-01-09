<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\TeamTransferRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        $drivernumberChangeRequests = DrivernumberChangeRequest::query()
            ->select("*")
            ->whereNotIn('drivernumber_change_requests.request_status_id', (function ($query) {
                $query->from('request_statuses')
                    ->select('request_statuses.id')
                    ->where('status', 'Closed');
            }))->get();

        $teamTransferRequests = TeamTransferRequest::query()
            ->select("*")
            ->whereNotIn('team_transfer_requests.request_status_id', (function ($query) {
                $query->from('request_statuses')
                    ->select('request_statuses.id')
                    ->where('status', 'Closed');
            }))->get();

        return view('private.request.index', compact('drivernumberChangeRequests', 'teamTransferRequests'));
    }

    public function handleDrivernumberChangeRequest(int $id): View
    {
        $drivernumberChangeRequest = DrivernumberChangeRequest::all()->where('id', '=', $id)->first();

        return view('private.request.drivernumber.handle', compact('drivernumberChangeRequest'));
    }

    public function handleTeamTransferRequest(int $id): View
    {
        return view('private.request.teamtransfer.handle');
    }
}
