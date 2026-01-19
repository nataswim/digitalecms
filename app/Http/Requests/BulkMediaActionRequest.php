<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkMediaActionRequest extends FormRequest
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
            'action' => ['required', 'string', 'in:delete,change_category'],
            'media_ids' => ['required', 'array', 'min:1'],
            'media_ids.*' => ['required', 'integer', 'exists:media,id'],
            'category_id' => ['nullable', 'required_if:action,change_category', 'exists:media_categories,id'],
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
            'action.required' => 'Veuillez sélectionner une action.',
            'action.in' => 'L\'action sélectionnée est invalide.',
            'media_ids.required' => 'Veuillez sélectionner au moins un média.',
            'media_ids.min' => 'Veuillez sélectionner au moins un média.',
            'category_id.required_if' => 'Veuillez sélectionner une catégorie de destination.',
        ];
    }

    /**
     * Get the media IDs from the request.
     *
     * @return array
     */
    public function getMediaIds(): array
    {
        return $this->input('media_ids', []);
    }
}