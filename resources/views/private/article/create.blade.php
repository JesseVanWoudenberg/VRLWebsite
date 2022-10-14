@extends('layouts.private-layout')

@section('page-title') Article - Create @endsection

@section('page') article-create-edit-delete @endsection

@section('content')

    <div>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('article.store') }}" method="POST">
                @csrf

                <label for="article_name">Article name</label>
                <input @error('name') @enderror type="text" id="article_name" name='article_name' value="{{ old('article_name') }}">

                <label for="author">Author</label>
                <input @error('name') @enderror type="text" id="author" name='author' value="{{ old('author') }}">

                <label for="description">Article</label>
                <textarea name="description" id="description" maxlength="500" value="{{ old('description') }}"></textarea>

                <input type="submit" value="Create Article">
            </form>
        </div>
    </div>

@endsection
