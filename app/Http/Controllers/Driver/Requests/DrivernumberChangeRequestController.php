<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequests\StoreDrivernumberChangeRequestRequest;
use App\Http\Requests\DriverRequests\UpdateDrivernumberChangeRequestRequest;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\RequestStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function edit(int $drivernumberChangeRequest)
    {
        $drivernumberchangerequest = DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first();

        return view('driver.requests.drivernumber.edit', compact('drivernumberchangerequest'));
    }

    public function update(UpdateDrivernumberChangeRequestRequest $request, int $drivernumberChangeRequest)
    {
        dd($drivernumberChangeRequest);
    }

    public function delete(int $drivernumberChangeRequest): View
    {
        $request = DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first();

        return view('driver.requests.drivernumber.delete', compact('drivernumberChangeRequest'));
    }

    public function destroy(int $drivernumberChangeRequest): RedirectResponse
    {
        DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first()->delete();

        return redirect()->route('driverpanel.requests')->with("Request cancelled");
    }
}
