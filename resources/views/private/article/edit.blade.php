@extends('layouts.private-layout')

@section('page-title') Article - Edit @endsection

@section('page') article-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Edit Article</h1>
            @endif
        </div>

        <form action="{{ route('article.update', ['article' => $article->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <label for="article_name">Article name</label>
            <input type="text" id="article_name" name='article_name' value="{{ $article->article_name }}" >

            <label for="author">Author</label>
            <input type="text" id="author" name='author' value="{{ $article->author }}">

            <label for="description">Article</label>
            <textarea name="description" id="description" maxlength="500">{{ $article->description }}</textarea>

            <input type="submit" value="edit">
        </form>
    </div>

@endsection
