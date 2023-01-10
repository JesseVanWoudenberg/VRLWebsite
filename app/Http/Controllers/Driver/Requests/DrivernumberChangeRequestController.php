<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequests\StoreDrivernumberChangeRequestRequest;
use App\Http\Requests\DriverRequests\UpdateDrivernumberChangeRequestRequest;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\RequestStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DrivernumberChangeRequestController extends Controller
{
    public function create(): View
    {
        User::checkIfValidDriver();

        return view('driver.requests.drivernumber.create');
    }

    public function show(int $id)
    {
        User::checkIfValidDriver();

        $drivernumberChangeRequest = DrivernumberChangeRequest::all()->where('id', '=', $id)->first();

        if ($drivernumberChangeRequest->request_status_id == RequestStatus::all()->where('status', '=', 'Denied')->first()->id)
        {
            return view('driver.requests.drivernumber.show', compact('drivernumberChangeRequest'));
        }
        else
        {
            abort(403);
        }
    }

    public function store(StoreDrivernumberChangeRequestRequest $request): RedirectResponse
    {
        User::checkIfValidDriver();

        $usedNumbers = array(1, 3, 4, 5, 6, 9, 10, 11, 12, 14, 16, 17, 18, 20, 22, 23, 24, 27, 31, 33, 44, 47, 55, 63, 76, 77);

        if (DrivernumberChangeRequest::all()->where('user_id', '=', Auth::id())->where('request_status_id', '=', RequestStatus::all()->where('status', '=', 'Opened')->first()->id)->count() > 0)
        {
            return redirect()->route('driverpanel.requests')->withErrors(['msg' => 'You already have an open drivernumber change request']);
        }
        elseif (in_array($request->newnumber, $usedNumbers))
        {
            return redirect()->route('driverpanel.requests')->withErrors(['msg' => 'You cannot use this drivernumber']);
        }

        $newRequest = new DrivernumberChangeRequest();
        $newRequest->request_status_id = RequestStatus::all()->where('status', '=', 'Opened')->first()->id;
        $newRequest->user_id = Auth::id();
        $newRequest->driver_id = Auth::user()->driver->id;
        $newRequest->new_drivernumber = $request->newnumber;

        $newRequest->save();

        return redirect()->route('driverpanel.requests')->with("Request sent");
    }

    public function edit(int $drivernumberChangeRequest): View
    {
        User::checkIfValidDriver();

        $drivernumberchangerequest = DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first();

        return view('driver.requests.drivernumber.edit', compact('drivernumberchangerequest'));
    }

    public function update(UpdateDrivernumberChangeRequestRequest $request, int $drivernumberChangeRequest)
    {
        User::checkIfValidDriver();
    }

    public function delete(int $drivernumberChangeRequest): View
    {
        User::checkIfValidDriver();

        $request = DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first();

        return view('driver.requests.drivernumber.delete', compact('drivernumberChangeRequest'));
    }

    public function destroy(int $drivernumberChangeRequest): RedirectResponse
    {
        User::checkIfValidDriver();

        DrivernumberChangeRequest::all()->where('id', '=', $drivernumberChangeRequest)->first()->delete();

        return redirect()->route('driverpanel.requests')->with("Request cancelled");
    }
}
