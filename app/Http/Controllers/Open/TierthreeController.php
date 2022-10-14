<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TierthreeController extends Controller
{
    public function index(): View
    {
        return view('public.tier2.index');
    }

    public function standings(): View
    {
        return view('public.tier2.standings');
    }

    public function lineup(): View
    {
        return view('public.tier2.lineup');
    }

    public function calendar(): View
    {
        return view('public.tier2.calendar');
    }
}
