<?php

namespace App\Http\Requests\TierRequests;

use Illuminate\Foundation\Http\FormRequest;

class TierStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tiernumber' => 'required|integer|min:1|unique:tiers'
        ];
    }
}
