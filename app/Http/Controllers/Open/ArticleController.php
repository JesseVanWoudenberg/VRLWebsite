<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('public.news', [
            'articles' => DB::table('articles')->paginate(5)
        ]);
    }
}
