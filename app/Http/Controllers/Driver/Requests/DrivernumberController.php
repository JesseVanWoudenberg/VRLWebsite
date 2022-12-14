<?php

namespace App\Http\Controllers\Driver\Requests;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DrivernumberController extends Controller
{
    public function create(): View
    {


        return view('driver.requests.drivernumber.create');
    }
}
