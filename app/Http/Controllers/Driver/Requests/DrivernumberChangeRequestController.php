<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequests\StoreDrivernumberChangeRequestRequest;
use App\Http\Requests\DriverRequests\UpdateDrivernumberChangeRequestRequest;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\RequestStatus;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Request;

class DrivernumberChangeRequestController extends Controller
{
    public function create(): View
    {
        return view('driver.requests.drivernumber.create');
    }

    public function store(StoreDrivernumberChangeRequestRequest $request)
    {
        $newRequest = new DrivernumberChangeRequest();
        $newRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Opened')->first()->id;
        $newRequest->user_id = Auth::id();
        $newRequest->driver_id = Auth::user()->driver->id;
        $newRequest->new_drivernumber = $request->newnumber;

        $newRequest->save();

        return redirect()->route('driverpanel.requests')->with("Request sent");
    }

    public function edit(DrivernumberChangeRequest $drivernumberChangeRequest)
    {
        //
    }

    public function update(UpdateDrivernumberChangeRequestRequest $request, DrivernumberChangeRequest $drivernumberChangeRequest)
    {
        //
    }

    public function delete(DrivernumberChangeRequest $drivernumberChangeRequest): View
    {
        return view('driver.requests.drivernumber.delete', compact('drivernumberChangeRequest'));
    }

    public function destroy(DrivernumberChangeRequest $drivernumberChangeRequest): RedirectResponse
    {
        $drivernumberChangeRequest->delete();

        return redirect()->route('driverpanel.requests')->with("Request cancelled");
    }
}
