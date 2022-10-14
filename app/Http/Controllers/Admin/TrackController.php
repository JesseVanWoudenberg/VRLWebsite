<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TrackController extends Controller
{
    public function index()
    {
        return view('private.track.index',[
            'tracks' => DB::table('tracks')->paginate(20)
        ]);
    }

    public function create()
    {
        return view('private.track.create');
    }

    public function store(Request $request)
    {
        $track = new Track();

        $track->name = $request->name;
        $track->country = $request->country;
        $track->length = $request->length;
        $track->turns = $request->turns;

        $track->save();

        return redirect()->route('track')->with('status', 'Track successfully added');
    }

    public function show(Track $track)
    {
        return view('private.track.show', compact('track'));
    }

    public function edit(Track $track)
    {
        return view('private.track.edit', compact('track'));
    }

    public function update(Request $request, Track $track)
    {
        $track->name = $request->name;
        $track->country = $request->country;
        $track->length = $request->length;
        $track->turns = $request->turns;

        $track->save();

        return redirect()->route('track')->with('status', 'Track successfully updated');

    }

    public function delete(Track $track): View
    {
        return view('private.track.delete', compact('track'));
    }


    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->route('track')->with('status', 'Track successfully deleted');
    }
}
