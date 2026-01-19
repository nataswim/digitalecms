<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\FichesCategory;
use App\Models\FichesSousCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller pour les fiches publiques
 */
class PublicFicheController extends Controller
{
    /**
     * Liste complète des fiches avec filtres
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $categorySlug = $request->input('category');
        $sousCategorySlug = $request->input('sous_category');

        // Query de base
        $query = Fiche::with(['category', 'sousCategory']);

        // Filtre par recherche
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filtre par catégorie
        if ($categorySlug) {
            $category = FichesCategory::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('fiches_category_id', $category->id);
            }
        }

        // Filtre par sous-catégorie
        if ($sousCategorySlug) {
            $sousCategory = FichesSousCategory::where('slug', $sousCategorySlug)->first();
            if ($sousCategory) {
                $query->where('fiches_sous_category_id', $sousCategory->id);
            }
        }

        // Pagination
        $fiches = $query->latest()->paginate(12);

        // Récupérer toutes les catégories et sous-catégories pour les filtres
        $categories = FichesCategory::withCount('fiches')->orderBy('name')->get();
        $sousCategories = FichesSousCategory::withCount('fiches')->orderBy('name')->get();

        return view('public.fiches.index', compact(
            'fiches', 
            'categories', 
            'sousCategories', 
            'search', 
            'categorySlug', 
            'sousCategorySlug'
        ));
    }

    /**
     * Fiches par catégorie
     */
    public function category(FichesCategory $category): View
    {
        $fiches = Fiche::with(['category', 'sousCategory'])
            ->where('fiches_category_id', $category->id)
            ->latest()
            ->paginate(12);

        $sousCategories = $category->sousCategories()
            ->withCount('fiches')
            ->orderBy('name')
            ->get();

        return view('public.fiches.category', compact('category', 'fiches', 'sousCategories'));
    }

    /**
     * Fiches par sous-catégorie
     */
    public function sousCategory(FichesCategory $category, FichesSousCategory $sousCategory): View
    {
        $fiches = Fiche::with(['category', 'sousCategory'])
            ->where('fiches_category_id', $category->id)
            ->where('fiches_sous_category_id', $sousCategory->id)
            ->latest()
            ->paginate(12);

        return view('public.fiches.sous-category', compact('category', 'sousCategory', 'fiches'));
    }

    /**
     * Détail d'une fiche
     */
    public function show(FichesCategory $category, Fiche $fiche): View
    {
        $fiche->load(['category', 'sousCategory']);

        // Fiches similaires (même catégorie)
        $relatedFiches = Fiche::with(['category'])
            ->where('fiches_category_id', $fiche->fiches_category_id)
            ->where('id', '!=', $fiche->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('public.fiches.show', compact('fiche', 'relatedFiches'));
    }
}