<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        return view('driver.requests.index');
    }
}
