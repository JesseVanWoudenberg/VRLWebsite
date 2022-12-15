<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Models\Requests\Drivernumberchangerequest;
use App\Models\Requests\Requeststatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DrivernumberchangerequestController extends Controller
{
    public function create(): View
    {
        return view('driver.requests.drivernumber.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $drivernumberRequest = new Drivernumberchangerequest();
        $drivernumberRequest->requeststatus_id = Requeststatus::all()
                                                            ->where('status', '=', 'opened')
                                                            ->first()->id;
        $drivernumberRequest->user_id = Auth::id();
        $drivernumberRequest->newnumber = $request->input('newnumber');
        $drivernumberRequest->save();

        return redirect()->route('driver-home')->with('message', 'Request sent');
    }
}
