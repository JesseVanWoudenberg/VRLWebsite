<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class  TrackController extends Controller
{
    public function index()
    {
        User::checkPermissions("track index");

        return view('private.track.index',[
            'tracks' => DB::table('tracks')->paginate(20)
        ]);
    }

    public function create()
    {
        User::checkPermissions("track create");

        return view('private.track.create');
    }

    public function store(Request $request)
    {
        User::checkPermissions("track create");

        $track = new Track();

        $track->name = $request->name;
        $track->country = $request->country;
        $track->length = $request->length;
        $track->turns = $request->turns;

        $track->save();

        $log = new Log();
        $log->action = "Stored track [ ID: " . $track->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('track')->with('status', 'Track successfully added');
    }

    public function show(Track $track)
    {
        User::checkPermissions("track show");

        return view('private.track.show', compact('track'));
    }

    public function edit(Track $track)
    {
        User::checkPermissions("track edit");

        return view('private.track.edit', compact('track'));
    }

    public function update(Request $request, Track $track)
    {
        User::checkPermissions("track edit");

        $track->name = $request->name;
        $track->country = $request->country;
        $track->length = $request->length;
        $track->turns = $request->turns;

        $track->save();

        $log = new Log();
        $log->action = "Edited track [ ID: " . $track->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('track')->with('status', 'Track successfully updated');

    }

    public function delete(Track $track): View
    {
        User::checkPermissions("track delete");

        return view('private.track.delete', compact('track'));
    }


    public function destroy(Track $track)
    {
        User::checkPermissions("track delete");

        $track->delete();

        $log = new Log();
        $log->action = "Deleted track [ ID: " . $track->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('track')->with('status', 'Track successfully deleted');
    }
}
