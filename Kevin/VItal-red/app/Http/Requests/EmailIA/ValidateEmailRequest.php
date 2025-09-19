<?php

namespace App\Http\Requests\EmailIA;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && in_array($this->user()->role, ['admin', 'medico']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'validation_status' => 'required|in:valid,invalid,needs_review',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'validation_status.required' => 'El estado de validación es requerido.',
            'validation_status.in' => 'El estado de validación debe ser: valid, invalid o needs_review.',
            'notes.string' => 'Las notas deben ser texto válido.',
            'notes.max' => 'Las notas no pueden exceder 1000 caracteres.',
        ];
    }
}
