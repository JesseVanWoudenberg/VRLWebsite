<?php

namespace App\Http\Requests\ArticleRequests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'article_name' => 'required|string|max:70|unique:articles',
            'author' => 'required|string|max:45|unique:articles',
            'description' => 'required|string|max:500|unique:articles'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
