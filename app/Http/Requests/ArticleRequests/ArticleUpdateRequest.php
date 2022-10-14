<?php

namespace App\Http\Requests\ArticleRequests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $article = $this->route('article');

        return [
            'article_name' => 'required|string|max:70|unique:articles,article_name,'.$article->id,
            'author' => 'required|string|max:45|unique:articles,author,'.$article->id,
            'description' => 'required|string|max:500|unique:articles,description,'.$article->id
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
