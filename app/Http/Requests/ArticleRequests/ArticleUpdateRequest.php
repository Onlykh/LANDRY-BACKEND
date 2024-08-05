<?php

namespace App\Http\Requests\ArticleRequests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'reference' => ['required', 'string'],
            'entitled' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'integer', 'exists:p_categories,category'],
            'unit' => ['required', 'string', 'exists:p_units,unit'],
            'color' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
        ];
    }
}
