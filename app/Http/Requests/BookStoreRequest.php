<?php

namespace App\Http\Requests;

use App\Models\BookHouse;
use App\Traits\ValidateAuthorsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookStoreRequest extends FormRequest
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
            $this->checkIfUserHasBookHouse();
            $this->authors();
        }
    }

    protected function checkIfUserHasBookHouse()
    {
        $bookHouse = BookHouse::where('user_id', auth()->id())->first();
        if (empty($bookHouse)) {
            throw ValidationException::withMessages([
                'message' => ['You do not have Book House. Please create Book House.'],
            ]);
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
