<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequests\ArticleStoreRequest;
use App\Http\Requests\ArticleRequests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("article index");

        $articles = Article::query()
            ->select("*")
            ->paginate(10);

        return view('private.article.index', compact('articles'));
    }

    public function create(): View
    {
        User::checkPermissions("article create");

        return view('private.article.create');
    }

    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        User::checkPermissions("article create");

        $article = new Article();
        $article->article_name = $request->article_name;
        $article->author = $request->author;
        $article->description = $request->description;

        $article->save();

        $log = new Log();
        $log->action = "Stored article [ ID: " . $article->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('article')->with('status', 'Article successfully created');

    }

    public function show(Article $article): View
    {
        User::checkPermissions("article show");

        return view('private.article.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        User::checkPermissions("article edit");

        return view('private.article.edit', compact('article'));
    }

    public function update(ArticleUpdateRequest $request, Article $article): RedirectResponse
    {
        User::checkPermissions("article edit");

        $article->article_name = $request->article_name;
        $article->author = $request->author;
        $article->description = $request->description;

        $article->save();

        $log = new Log();
        $log->action = "Edited article [ ID: " . $article->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('article')->with('status', 'Article successfully updated');
    }

    public function delete(Article $article): View
    {
        User::checkPermissions("article delete");

        return view('private.article.delete', compact('article'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        User::checkPermissions("article delete");

        $article->delete();

        $log = new Log();
        $log->action = "Deleted article [ ID: " . $article->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('article')->with('status', 'Article successfully deleted');
    }
}
