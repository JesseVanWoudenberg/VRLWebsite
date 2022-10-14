@extends('layouts.private-layout')

@section('page-title') Tier - Index @endsection

@section('page') tier-index @endsection

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
            @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'added')) added @endif
        @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) deleted @endif
            ">
            {{ \Illuminate\Support\Facades\Session::get('status') }}
        </div>
    @endif

    <div class="tier-list-container">

        <h1><a href="{{ route('tier.create') }}">Add tier</a></h1>

        <table>

            <thead>
                <tr>
                    <th>Tier number</th>
                </tr>
            </thead>

            <tbody>
            @foreach($tiers as $tier)
                <tr>
                    <td>{{ $tier->tiernumber }}</td>
                    <td><a href="{{ route('tier.delete', ['tier' => $tier->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tiers->links() }}

    </div>

@endsection
