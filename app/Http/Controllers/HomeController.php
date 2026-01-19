<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\FichesCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index(): View
    {
        // Récupérer les 6 dernières fiches pour l'accueil
        $recentFiches = Fiche::with(['category', 'sousCategory'])
            ->latest()
            ->limit(6)
            ->get();

        // Récupérer les catégories avec compteur
        $categories = FichesCategory::withCount('fiches')
            ->orderBy('name')
            ->get();

        return view('home', compact('recentFiches', 'categories'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }
}