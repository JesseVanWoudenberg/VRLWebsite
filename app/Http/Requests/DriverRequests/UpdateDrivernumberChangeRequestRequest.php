<?php

namespace App\Http\Requests\DriverRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDrivernumberChangeRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): bool
    {
        return [
            //
        ];
    }
}
