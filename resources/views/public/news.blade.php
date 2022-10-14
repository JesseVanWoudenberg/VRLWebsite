@extends('layouts.public-layout')

@section('page-title') News @endsection

@section('page') news @endsection

@section('content')

    <div class="news-container">

        @foreach($articles as $article)

            <div class="article">

                <p>{{ $article->article_name }}</p>

                <p>{{ $article->description }}</p>

                <p>By: {{ $article->author }}</p>

            </div>

        @endforeach

    </div>

    {{ $articles->links() }}

@endsection
