<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:80'],
            'notes' => ['required', 'max:1200'],
            'completed' => ['required', 'boolean'],
            'priority' => ['required', Rule::in(['none', 'low', 'medium', 'high'])],
            'due_date' => ['required', 'date'],
        ];
    }
}
