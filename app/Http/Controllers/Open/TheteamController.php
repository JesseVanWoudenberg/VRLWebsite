<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TheteamController extends Controller
{
    public function index(): View
    {
        return view('public.the-team');
    }
}
