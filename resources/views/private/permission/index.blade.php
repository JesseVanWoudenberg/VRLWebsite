@php use Illuminate\Support\Facades\Session; @endphp

@extends('layouts.private-layout')

@section('page-title')
    Permission - Index
@endsection

@section('page')
    private-index
@endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(Session::exists('status'))
                <h1
                    @if(Illuminate\Support\Str::contains(Session::get('status'), 'create')) class="created" @endif
                    @if(Illuminate\Support\Str::contains(Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(Session::get('status'), 'updated')) class="edited" @endif>
                    {{ Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Permissions</h1>
            @endif

            @can('article create')
                <div class="index-buttons-container">
                    <a href="{{ route('permission.create') }}">
                        <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                        Add new permission
                    </a>
                </div>
            @endcan
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                </tr>
                </thead>

                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("permission show"))
                                <td class="info-button">
                                    <a href="{{ route('permission.show', ['permission' => $permission->id]) }}">
                                        <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                        More info
                                    </a>
                                </td>
                            @endif
                        @endif

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("permission edit"))
                                <td class="edit-button">
                                    <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}">
                                        <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                        Edit
                                    </a>
                                </td>
                            @endif
                        @endif

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("permission delete"))
                                <td class="delete-button">
                                    <a href="{{ route('permission.delete', ['permission' => $permission->id]) }}">
                                        <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                        Delete
                                    </a>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

{{--        {{ $permission->links() }}--}}

    </div>

@endsection
