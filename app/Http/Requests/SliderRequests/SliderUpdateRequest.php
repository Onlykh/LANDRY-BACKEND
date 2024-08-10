<?php

namespace App\Http\Requests\SliderRequests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'entitled' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'link' => ['nullable', 'string', 'url'],
            'position' => ['nullable', 'string'],
        ];
    }
}
