<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
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
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['required', 'file', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:5120'], // 5MB
            'names' => ['nullable', 'array'],
            'names.*' => ['nullable', 'string', 'max:255'],
            'alt_texts' => ['nullable', 'array'],
            'alt_texts.*' => ['nullable', 'string', 'max:255'],
            'media_category_id' => ['nullable', 'exists:media_categories,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'files.required' => 'Veuillez sélectionner au moins un fichier.',
            'files.*.mimes' => 'Le fichier doit être une image (JPEG, PNG, GIF, WebP, SVG).',
            'files.*.max' => 'Le fichier ne doit pas dépasser 5 MB.',
        ];
    }
}