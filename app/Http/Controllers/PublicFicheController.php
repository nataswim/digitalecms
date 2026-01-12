<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\FichesCategory;
use App\Models\FichesSousCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Controller pour la partie publique des fiches
 * 
 * Gère l'affichage des fiches pour les visiteurs et utilisateurs authentifiés
 * Respecte les niveaux de visibilité (public/authenticated)
 */
class PublicFicheController extends Controller
{
    /**
     * Affiche la page d'accueil des fiches avec les catégories et fiches en vedette
     */
    public function index(): View
    {
        // Récupérer les catégories actives avec le nombre de fiches publiées
        $categories = FichesCategory::active()
            ->ordered()
            ->withCount(['fiches' => function ($query) {
                $query->published()
                    ->visibleTo(Auth::user());
            }])
            ->get()
            ->map(function ($category) {
                // Renommer le compteur pour plus de clarté
                $category->published_fiches_count = $category->fiches_count;
                return $category;
            });

        // Récupérer les fiches en vedette
        $featuredFiches = Fiche::with(['category', 'sousCategory'])
            ->published()
            ->featured()
            ->visibleTo(Auth::user())
            ->ordered()
            ->limit(6)
            ->get();

        return view('public.fiches.index', compact('categories', 'featuredFiches'));
    }

    /**
     * Affiche les fiches d'une catégorie
     */
    public function category(FichesCategory $category): View|RedirectResponse
    {
        // Vérifier que la catégorie est active
        if (!$category->is_active) {
            return redirect()->route('public.fiches.index')
                ->with('error', 'Cette catégorie n\'est pas accessible.');
        }

        // Récupérer les sous-catégories actives avec le nombre de fiches publiées
        $sousCategories = $category->activeSousCategories()
            ->withCount(['fiches' => function ($query) {
                $query->published()
                    ->visibleTo(Auth::user());
            }])
            ->get()
            ->map(function ($sousCategory) {
                $sousCategory->published_fiches_count = $sousCategory->fiches_count;
                return $sousCategory;
            });

        // Récupérer les fiches de la catégorie
        $fiches = Fiche::with(['category', 'sousCategory', 'creator'])
            ->where('fiches_category_id', $category->id)
            ->published()
            ->visibleTo(Auth::user())
            ->ordered()
            ->paginate(12);

        return view('public.fiches.category', compact('category', 'sousCategories', 'fiches'));
    }

    /**
     * Affiche les fiches d'une sous-catégorie
     */
    public function sousCategory(
        FichesCategory $category,
        FichesSousCategory $sousCategory
    ): View|RedirectResponse {
        // Vérifier que la catégorie est active
        if (!$category->is_active) {
            return redirect()->route('public.fiches.index')
                ->with('error', 'Cette catégorie n\'est pas accessible.');
        }

        // Vérifier que la sous-catégorie est active
        if (!$sousCategory->is_active) {
            return redirect()->route('public.fiches.category', $category)
                ->with('error', 'Cette sous-catégorie n\'est pas accessible.');
        }

        // Vérifier que la sous-catégorie appartient bien à la catégorie
        if ($sousCategory->fiches_category_id !== $category->id) {
            return redirect()->route('public.fiches.index')
                ->with('error', 'Sous-catégorie invalide.');
        }

        // Récupérer les fiches de la sous-catégorie
        $fiches = Fiche::with(['category', 'sousCategory', 'creator'])
            ->where('fiches_sous_category_id', $sousCategory->id)
            ->published()
            ->visibleTo(Auth::user())
            ->ordered()
            ->paginate(12);

        return view('public.fiches.sous-category', compact('category', 'sousCategory', 'fiches'));
    }

    /**
     * Affiche le détail d'une fiche
     */
    public function show(FichesCategory $category, Fiche $fiche): View|RedirectResponse
    {
        // Vérifier que la catégorie est active
        if (!$category->is_active) {
            return redirect()->route('public.fiches.index')
                ->with('error', 'Cette catégorie n\'est pas accessible.');
        }

        // Vérifier que la fiche appartient bien à la catégorie
        if ($fiche->fiches_category_id !== $category->id) {
            return redirect()->route('public.fiches.index')
                ->with('error', 'Fiche invalide.');
        }

        // Vérifier que la fiche est publiée (sauf pour admin/editor)
        $user = Auth::user();
        if (!$fiche->is_published && (!$user || (!$user->hasRole('admin') && !$user->hasRole('editor')))) {
            return redirect()->route('public.fiches.category', $category)
                ->with('error', 'Cette fiche n\'est pas encore publiée.');
        }

        // Charger les relations
        $fiche->load(['category', 'sousCategory', 'creator', 'updater']);

        // Incrémenter le compteur de vues (seulement pour les visiteurs)
        // Ne pas compter les vues des admins/editors
        if (!$user || (!$user->hasRole('admin') && !$user->hasRole('editor'))) {
            $fiche->incrementViews();
        }

        // Récupérer les fiches associées (même catégorie, exclure la fiche actuelle)
        $relatedFiches = Fiche::with(['category'])
            ->where('fiches_category_id', $category->id)
            ->where('id', '!=', $fiche->id)
            ->published()
            ->visibleTo($user)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('public.fiches.show', compact('fiche', 'category', 'relatedFiches'));
    }
}
