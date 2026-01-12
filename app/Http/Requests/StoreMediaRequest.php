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
        return auth()->check() && auth()->user()->hasPermission('media.upload');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'files' => ['required', 'array', 'min:1'],
            'files.*' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120' // 5MB
            ],
            'names' => ['nullable', 'array'],
            'names.*' => ['nullable', 'string', 'max:255'],
            'alt_texts' => ['nullable', 'array'],
            'alt_texts.*' => ['nullable', 'string', 'max:255'],
            'media_category_id' => ['nullable', 'exists:media_categories,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'files.required' => 'Vous devez sélectionner au moins un fichier.',
            'files.*.image' => 'Le fichier doit être une image.',
            'files.*.mimes' => 'Format accepté : JPEG, PNG, JPG, GIF, WebP.',
            'files.*.max' => 'La taille maximale par fichier est de 5 Mo.',
            'media_category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ];
    }
}