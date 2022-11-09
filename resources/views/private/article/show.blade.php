@extends('layouts.private-layout')

@section('page-title') Article - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Article</h1>

        </div>

        <div class="show-content">

            <h1>Title</h1>
            <p>{{ $article->article_name }}</p>

            <h1>Author</h1>
            <p>{{ $article->author }}</p>

            <h1>Created At</h1>
            <p>{{ $article->created_at }}</p>

            <h1>Article</h1>
            <p>{{ $article->description }}</p>

        </div>
    </div>

@endsection
