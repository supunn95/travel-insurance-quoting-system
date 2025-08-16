<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
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
            'destination_id' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'total_travelers' => 'required|integer|min:1',
            'coverage_options' => 'required|array',
            'coverage_options.*' => 'exists:coverage_options,id',
        ];
    }

    public function messages()
    {
        return [
            'destination_id.required' => 'The destination field is required.',
            'total_travelers.required' => 'The Number of travelers field is required.',
        ];
    }
}
