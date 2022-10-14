<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Powerunit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PowerunitController extends Controller
{
    public function index()
    {
        return view('private.powerunit.index',[
            'powerunits' => DB::table('powerunits')->paginate(20)
        ]);
    }

    public function create()
    {
        return view('private.powerunit.create');
    }

    public function store(Request $request)
    {
        $powerunit = new Powerunit();

        $powerunit->name = $request->name;

        $powerunit->save();

        return redirect()->route('powerunit')->with('status', 'Power unit successfully added');
    }

    public function show(Powerunit $powerunit)
    {
        return view('private.powerunit.show', compact('powerunit'));
    }

    public function edit(Powerunit $powerunit)
    {
        return view('private.powerunit.edit', compact('powerunit'));
    }

    public function update(Request $request, Powerunit $powerunit)
    {
        $powerunit->name = $request->name;

        $powerunit->save();

        return redirect()->route('powerunit')->with('status', 'Power unit successfully updated');
    }

    public function delete(Powerunit $powerunit)
    {
        return view('private.powerunit.delete', compact('powerunit'));
    }

    public function destroy(Powerunit $powerunit)
    {
        $powerunit->delete();
        return redirect()->route('powerunit')->with('status', 'Power unit successfully deleted');
    }
}
