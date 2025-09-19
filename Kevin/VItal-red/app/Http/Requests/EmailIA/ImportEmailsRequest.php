<?php

namespace App\Http\Requests\EmailIA;

use Illuminate\Foundation\Http\FormRequest;

class ImportEmailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ia_path' => 'required|string|max:500',
            'force' => 'sometimes|boolean',
            'limit' => 'sometimes|integer|min:1|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'ia_path.required' => 'La ruta del sistema de IA es requerida.',
            'ia_path.string' => 'La ruta debe ser una cadena de texto válida.',
            'ia_path.max' => 'La ruta no puede exceder 500 caracteres.',
            'limit.integer' => 'El límite debe ser un número entero.',
            'limit.min' => 'El límite mínimo es 1.',
            'limit.max' => 'El límite máximo es 1000.',
        ];
    }
}
