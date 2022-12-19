<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequests\StoreTeamTransferRequestRequest;
use App\Http\Requests\DriverRequests\UpdateTeamTransferRequestRequest;
use App\Models\Requests\RequestStatus;
use App\Models\Requests\TeamTransferRequest;
use App\Models\Team;
use Auth;
use Illuminate\View\View;

;

class TeamTransferRequestController extends Controller
{
    public function create(): View
    {
        $teams = Team::all();

        return view('driver.requests.teamtransfer.create', compact(['teams']));
    }

    public function store(StoreTeamTransferRequestRequest $request)
    {
        $newRequest = new TeamTransferRequest();
        $newRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Opened')->first()->id;
        $newRequest->user_id = Auth::id();
        $newRequest->driver_id = Auth::user()->driver->id;
        $newRequest->team_id = $request->team_id;
        $newRequest->reason = $request->reason;

        $newRequest->save();

        return redirect()->route('driverpanel.requests')->with("Request successfully sent");
    }

    public function show(TeamTransferRequest $teamTransferRequest)
    {
        //
    }

    public function edit(TeamTransferRequest $teamTransferRequest)
    {
        //
    }

    public function update(UpdateTeamTransferRequestRequest $request, TeamTransferRequest $teamTransferRequest)
    {
        //
    }
}
