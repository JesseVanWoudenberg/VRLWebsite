@extends('layouts.private-layout')

@section('page-title') Article - Index @endsection

@section('page') article-index @endsection

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
            @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) created @endif
            @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) deleted @endif
            ">
            {{ \Illuminate\Support\Facades\Session::get('status') }}
        </div>
    @endif

    <div class="article-list-container">

        <h1><a href="{{ route('article.create') }}">Create new article</a></h1>

        <table>

            <thead>
                <tr>
                    <th>ARTICLE NAME</th>
                    <th>AUTHOR</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->article_name }}</td>
                        <td>{{ $article->author }}</td>
                        <td><a href="{{ route('article.show', ['article' => $article->id]) }}">More info</a></td>
                        <td><a href="{{ route('article.edit', ['article' => $article->id]) }}">Edit</a></td>
                        <td><a href="{{ route('article.delete', ['article' => $article->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $articles->links() }}

    </div>

@endsection
