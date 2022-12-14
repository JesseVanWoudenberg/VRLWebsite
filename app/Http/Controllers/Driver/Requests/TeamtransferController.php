<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamtransferController extends Controller
{
    public function create(): View
    {


        return view('driver.requests.teamtransfer.create');
    }
}
