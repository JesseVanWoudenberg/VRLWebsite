<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\TeamTransferRequest;
use App\Models\User;
use Auth;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        User::checkIfValidDriver();

        $drivernumberChangeRequests = DrivernumberChangeRequest::all()->where('user_id', '=', Auth::id())->sortByDesc('updated_at');
        $teamTransferChangeRequests = TeamTransferRequest::all()->where('user_id', '=', Auth::id())->sortByDesc('updated_at');

        return view('driver.requests.index', compact(['drivernumberChangeRequests', 'teamTransferChangeRequests']));
    }
}
