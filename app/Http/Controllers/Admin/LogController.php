<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LogController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("log index");

        $logs = Log::query()->orderBy('created_at', 'desc')->paginate(10);

        return view('private.log.index', compact('logs'));
    }

    public function show(Log $log): View
    {
        User::checkPermissions("log show");

        return view('private.log.show', compact('log'));
    }
}
