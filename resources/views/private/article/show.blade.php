@extends('layouts.private-layout')

@section('page-title') Article - Show @endsection

@section('page') article-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <thead>
                <tr>
                    <th>Article name</th>
                    <th>Author</th>
                    <th>Created at</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $article->article_name }}</td>
                    <td>{{ $article->author }}</td>
                    <td>{{ $article->created_at }}</td>
                </tr>
            </tbody>
        </table>

        <div class="article-text-container">
            <h1>Article content</h1>
            <p>{{ $article->description }}</p>
        </div>
    </div>

@endsection
