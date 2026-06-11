<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'texte_source' => ['required', 'string', 'min:10', 'max:5000']
        ];
    }

    public function messages(): array
    {
        return [
            'texte_source.required' => 'Le texte du reçu est obligatoire.',
            'texte_source.string' => 'Le texte du reçu doit être une chaîne de caractères.',
            'texte_source.min' => 'Le texte du reçu doit contenir au moins 10 caractères.',
            'texte_source.max' => 'Le texte du reçu ne doit pas dépasser 5000 caractères.',
        ];
    }
}
