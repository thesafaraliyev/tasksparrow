<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|string|min:2|max:150',
            'description' => 'required|string|string|min:3|max:750',
            'deadline' => 'required|string|date_format:Y-m-d\TH:i',
        ];
    }
}
