<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequests\ArticleStoreRequest;
use App\Http\Requests\ArticleRequests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article index")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('private.article.index', [
            'articles' => DB::table('articles')->paginate(20)
        ]);
    }

    public function create(): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article create")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('private.article.create');
    }

    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article create")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $news = new Article();
        $news->article_name = $request->article_name;
        $news->author = $request->author;
        $news->description = $request->description;
        $news->save();
        return redirect()->route('article')->with('status', 'Article successfully created');
    }

    public function show(Article $article): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article show")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('private.article.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article edit")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('private.article.edit', compact('article'));
    }

    public function update(ArticleUpdateRequest $request, Article $article): RedirectResponse
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article edit")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $article->article_name = $request->article_name;
        $article->author = $request->author;
        $article->description = $request->description;
        $article->save();

        return redirect()->route('article')->with('status', 'Article successfully updated');
    }

    public function delete(Article $article): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article delete")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        return view('private.article.delete', compact('article'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("article delete")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $article->delete();
        return redirect()->route('article')->with('status', 'Article successfully deleted');
    }
}
