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
        return auth()->check() && auth()->user()->hasPermission('media.manage');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:delete,change_category'],
            'media_ids' => ['required', 'json'],
            'category_id' => ['nullable', 'exists:media_categories,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'action.required' => 'Vous devez sélectionner une action.',
            'action.in' => 'Action non valide.',
            'media_ids.required' => 'Aucun média sélectionné.',
            'media_ids.json' => 'Format de données invalide.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ];
    }

    /**
     * Get the validated media IDs as an array.
     */
    public function getMediaIds(): array
    {
        $mediaIds = json_decode($this->input('media_ids'), true);
        
        return is_array($mediaIds) ? array_filter($mediaIds, 'is_numeric') : [];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validation supplémentaire pour change_category
            if ($this->input('action') === 'change_category' && !$this->filled('category_id')) {
                $validator->errors()->add('category_id', 'Vous devez sélectionner une catégorie.');
            }

            // Vérifier que media_ids contient des IDs valides
            $mediaIds = $this->getMediaIds();
            if (empty($mediaIds)) {
                $validator->errors()->add('media_ids', 'Aucun média valide sélectionné.');
            }
        });
    }
}