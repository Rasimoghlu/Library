<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookHouseStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:book_houses'
        ];
    }

    public function messages()
    {
        return [
          'name.unique' => 'You are already created Book House.'
        ];
    }
}
