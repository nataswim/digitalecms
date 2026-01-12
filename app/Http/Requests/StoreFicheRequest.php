<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFicheRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:fiches,slug',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|string|max:2048',
            'visibility' => 'required|string|in:public,authenticated',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'fiches_category_id' => 'nullable|exists:fiches_categories,id',
            'fiches_sous_category_id' => 'nullable|exists:fiches_sous_categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_og_image' => 'nullable|string|max:2048',
            'meta_og_url' => 'nullable|string|max:2048',
            'published_at' => 'nullable|date',
        ];
    }

    /**
     * Custom validation
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Au moins une catégorie ou sous-catégorie requise
            if (!$this->fiches_category_id && !$this->fiches_sous_category_id) {
                $validator->errors()->add('fiches_category_id', 'Une catégorie ou une sous-catégorie est obligatoire.');
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de la fiche est obligatoire.',
            'short_description.required' => 'La description courte est obligatoire.',
            'visibility.required' => 'La visibilité est obligatoire.',
            'visibility.in' => 'La visibilité doit être "public" ou "authenticated".',
            'fiches_category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'fiches_sous_category_id.exists' => 'La sous-catégorie sélectionnée n\'existe pas.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Convertir is_featured en boolean
        if ($this->has('is_featured')) {
            $this->merge([
                'is_featured' => $this->boolean('is_featured')
            ]);
        } else {
            $this->merge([
                'is_featured' => false
            ]);
        }

        // Convertir is_published en boolean
        if ($this->has('is_published')) {
            $this->merge([
                'is_published' => $this->boolean('is_published')
            ]);
        }

        // S'assurer que visibility a une valeur par défaut
        if (!$this->has('visibility') || empty($this->visibility)) {
            $this->merge([
                'visibility' => 'public'
            ]);
        }
    }
}