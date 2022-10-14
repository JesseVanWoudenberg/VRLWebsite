@extends('layouts.private-layout')

@section('page-title') Power unit - Index @endsection

@section('page') powerunit-index @endsection

@section('content')

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Session::exists('status'))
        <div class="message
            @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'added')) created @endif
        @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) deleted @endif
            ">
            {{ \Illuminate\Support\Facades\Session::get('status') }}
        </div>
    @endif

    <div class="powerunit-list-container">

        <h1><a href="{{ route('powerunit.create') }}">Add new powerunit</a></h1>

        <table>

            <thead>
            <tr>
                <th>POWER UNIT NAME</th>
            </tr>
            </thead>

            <tbody>
            @foreach($powerunits as $powerunit)
                <tr>
                    <td>{{ $powerunit->name }}</td>
                    <td><a href="{{ route('powerunit.show', ['powerunit' => $powerunit->id]) }}">More info</a></td>
                    <td><a href="{{ route('powerunit.edit', ['powerunit' => $powerunit->id]) }}">Edit</a></td>
                    <td><a href="{{ route('powerunit.delete', ['powerunit' => $powerunit->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

        {{ $powerunits->links() }}

    </div>

@endsection
