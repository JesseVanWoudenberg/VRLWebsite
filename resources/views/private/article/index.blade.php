 @extends('layouts.private-layout')

@section('page-title') Article - Index @endsection

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
                <h1>Manage Articles</h1>
            @endif

            @can('article create')
                <div class="index-buttons-container">
                    <a href="{{ route('article.create') }}">
                        <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                        Add new article
                    </a>
                </div>
            @endcan
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article Name</th>
                    <th>Author</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->article_name }}</td>
                        <td>{{ $article->author }}</td>

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("article show"))
                                <td class="info-button">
                                    <a href="{{ route('article.show', ['article' => $article->id]) }}">
                                        <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                        More info
                                    </a>
                                </td>
                            @endif
                        @endif

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("article edit"))
                                <td class="edit-button">
                                    <a href="{{ route('article.edit', ['article' => $article->id]) }}">
                                        <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                        Edit
                                    </a>
                                </td>
                            @endif
                        @endif

                        @if(Auth::check())
                            @if (Auth::user()->hasPermissionTo("article delete"))
                                <td class="delete-button">
                                    <a href="{{ route('article.delete', ['article' => $article->id]) }}">
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

        {{ $articles->links() }}

    </div>

@endsection
