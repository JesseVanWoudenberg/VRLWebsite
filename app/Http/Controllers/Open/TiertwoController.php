<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TiertwoController extends Controller
{
    public function index(): View
    {
        return view('public.tier3.index');
    }

    public function standings(): View
    {
        return view('public.tier3.standings');
    }

    public function lineup(): View
    {
        return view('public.tier3.lineup');
    }

    public function calendar(): View
    {
        return view('public.tier3.calendar');
    }
}
