<?php

namespace App\Http\Requests\OrderHeaderRequests;

use Illuminate\Foundation\Http\FormRequest;

class OrderHeaderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ref_service' => ['required', 'string', 'exists:p_services,reference'],
            'phone_number' => ['required', 'numeric'],
            'pick_up_date' => ['required', 'date'],
            'delivery_date' => ['required', 'date'],

            'pick_up_address' => ['required', 'array'],
            'delivery_address' => ['required', 'array'],

            'total_ht' => ['required', 'numeric'],
            'total_tva' => ['required', 'numeric'],
            'total_ttc' => ['required', 'numeric'],
            'total_discount' => ['required', 'numeric'],
            'delivery_cost' => ['required', 'numeric'],
            'net_to_pay' => ['required', 'numeric'],

            'note' => ['nullable', 'string'],

            'order_lines' => ['required', 'array'],
            'order_lines.*.ref_article' => ['required', 'string', 'exists:p_articles,reference'],
            'order_lines.*.qte' => ['required', 'numeric'],
            'order_lines.*.unit_price_ht' => ['required', 'numeric'],
            'order_lines.*.amount_ht' => ['required', 'numeric'],
            'order_lines.*.note' => ['nullable', 'string'],
        ];
    }
}
