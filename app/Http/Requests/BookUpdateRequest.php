<?php

namespace App\Http\Requests;

use App\Traits\ValidateAuthorsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookUpdateRequest extends FormRequest
{
    use ValidateAuthorsTrait;

    protected $rules = [
        'name' => 'required|string',
        'authors' => 'required|array',
    ];

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
     * @throws ValidationException
     */
    public function prepareForValidation(): void
    {
        if (!empty($this->all())) {
            $this->authors();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }

    protected function mergeRules(array $rules): void
    {
        $this->rules = array_merge($this->rules, $rules);
    }
}
