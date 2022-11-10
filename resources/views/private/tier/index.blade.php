@extends('layouts.private-layout')

@section('page-title') Tier - Index @endsection

@section('page') private-index @endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(\Illuminate\Support\Facades\Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'updated')) class="edited" @endif>
                    {{ \Illuminate\Support\Facades\Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Tiers</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('tier.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new tier
                </a>
            </div>
        </div>

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

                    <td class="delete-button">
                        <a href="{{ route('tier.delete', ['tier' => $tier->id]) }}">
                            <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        {{ $tiers->links() }}--}}

    </div>

@endsection
