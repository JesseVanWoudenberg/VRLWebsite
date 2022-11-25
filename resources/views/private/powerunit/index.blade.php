@extends('layouts.private-layout')

@section('page-title') Power unit - Index @endsection

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
                <h1>Manage Power units</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('powerunit.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new power unit
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($powerunits as $powerunit)
                        <tr>
                            <td>{{ $powerunit->name }}</td>

                            <td class="info-button">
                                <a href="{{ route('powerunit.show', ['powerunit' => $powerunit->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                    More info
                                </a>
                            </td>

                            <td class="edit-button">
                                <a href="{{ route('powerunit.edit', ['powerunit' => $powerunit->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                    Edit
                                </a>
                            </td>

                            <td class="delete-button">
                                <a href="{{ route('powerunit.delete', ['powerunit' => $powerunit->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

{{--        {{ $powerunits->links() }}--}}

    </div>

@endsection
