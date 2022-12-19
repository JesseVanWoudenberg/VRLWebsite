<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\TeamTransferRequest;
use Auth;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        $drivernumberChangeRequests = DrivernumberChangeRequest::all()->where('user_id', '=', Auth::id());
        $teamTransferChangeRequests = TeamTransferRequest::all()->where('user_id', '=', Auth::id());

        return view('driver.requests.index', compact(['drivernumberChangeRequests', 'teamTransferChangeRequests']));
    }
}
