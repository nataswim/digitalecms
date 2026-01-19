<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MediaCategory;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\StoreMediaCategoryRequest;
use App\Http\Requests\BulkMediaActionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Index des médias
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $perPage = $request->input('per_page', 24);

        $query = Media::with(['category', 'uploader'])
            ->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('original_name', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('media_category_id', $categoryId);
        }

        $media = $query->paginate($perPage);
        $categories = MediaCategory::active()->ordered()->get();
        $stats = $this->getMediaStats();

        return view('admin.media.index', compact('media', 'categories', 'stats', 'search', 'categoryId'));
    }
/**
 * Afficher le formulaire d'upload
 */
public function create()
{
    $categories = MediaCategory::active()->ordered()->get();
    
    return view('admin.media.create', compact('categories'));
}

/**
 * Afficher le formulaire d'édition
 */
public function edit(Media $media)
{
    $media->load(['category', 'uploader']);
    $categories = MediaCategory::active()->ordered()->get();
    
    return view('admin.media.edit', compact('media', 'categories'));
}
    /**
     * Upload de fichiers
     */
    public function store(StoreMediaRequest $request)
    {
        $uploadedFiles = [];
        $files = $request->file('files');
        $names = $request->input('names', []);
        $altTexts = $request->input('alt_texts', []);
        $categoryId = $request->input('media_category_id');

        foreach ($files as $index => $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $customName = $names[$index] ?? null;
                $altText = $altTexts[$index] ?? null;
                
                $uploadedFiles[] = $this->uploadFile($file, $categoryId, $customName, $altText);
            }
        }

        $count = count($uploadedFiles);
        $message = $count === 1 
            ? 'Fichier uploadé avec succès.' 
            : "{$count} fichiers uploadés avec succès.";

        return redirect()->route('admin.media.index')
            ->with('success', $message);
    }

    /**
     * Afficher un media
     */
    public function show(Media $media)
    {
        $media->load(['category', 'uploader']);
        $categories = MediaCategory::active()->ordered()->get();
        
        return view('admin.media.show', compact('media', 'categories'));
    }

    /**
     * Mettre à jour un media
     */
    public function update(Request $request, Media $media)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'media_category_id' => ['nullable', 'exists:media_categories,id'],
        ]);

        $media->update($request->only([
            'name', 'alt_text', 'description', 'media_category_id'
        ]));

        return redirect()->route('admin.media.show', $media)
            ->with('success', 'Média mis à jour avec succès.');
    }

    /**
     * Supprimer un media
     */
    public function destroy(Media $media)
    {
        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Média supprimé avec succès.');
    }

    /**
     * Actions en masse
     */
    public function bulkAction(BulkMediaActionRequest $request)
    {
        $mediaIds = $request->getMediaIds();
        $action = $request->input('action');

        if (empty($mediaIds)) {
            return redirect()->back()
                ->with('error', 'Aucun média sélectionné.');
        }

        try {
            switch ($action) {
                case 'delete':
                    $count = $this->bulkDelete($mediaIds);
                    return redirect()->back()
                        ->with('success', "{$count} média(s) supprimé(s) avec succès.");

                case 'change_category':
                    $categoryId = $request->input('category_id');
                    $count = $this->bulkChangeCategory($mediaIds, $categoryId);
                    $categoryName = $categoryId 
                        ? MediaCategory::find($categoryId)->name 
                        : 'Aucune catégorie';
                    return redirect()->back()
                        ->with('success', "{$count} média(s) déplacé(s) vers « {$categoryName} » avec succès.");

                default:
                    return redirect()->back()
                        ->with('error', 'Action non reconnue.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'action en masse.');
        }
    }

    /**
     * Gestion des catégories
     */
    public function categories()
    {
        $categories = MediaCategory::withCount('media')
            ->ordered()
            ->get();

        return view('admin.media.categories', compact('categories'));
    }

    /**
     * Créer une catégorie
     */
    public function storeCategory(StoreMediaCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $originalSlug = $data['slug'];
        $counter = 1;
        while (MediaCategory::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        MediaCategory::create($data);

        return redirect()->route('admin.media.categories')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Supprimer une catégorie
     */
    public function destroyCategory(MediaCategory $category)
    {
        if ($category->media()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer une catégorie contenant des médias.');
        }

        $category->delete();

        return redirect()->route('admin.media.categories')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    // ========== MÉTHODES PRIVÉES ==========

    private function uploadFile(UploadedFile $file, ?int $categoryId = null, ?string $customName = null, ?string $altText = null): Media
    {
        $fileName = $this->generateUniqueFileName($file);
        $mediaPath = 'media';
        
        if (!Storage::disk('public')->exists($mediaPath)) {
            Storage::disk('public')->makeDirectory($mediaPath);
        }
        
        $filePath = $mediaPath . '/' . $fileName;
        Storage::disk('public')->putFileAs($mediaPath, $file, $fileName);
        
        $metadata = $this->extractMetadata($file, $filePath);
        
        return Media::create([
            'name' => $customName ?: $this->cleanFileName($file->getClientOriginalName()),
            'file_name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'path' => $filePath,
            'size' => $file->getSize(),
            'metadata' => $metadata,
            'alt_text' => $altText,
            'media_category_id' => $categoryId,
        ]);
    }

    private function generateUniqueFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('Y-m-d_H-i-s');
        $random = Str::random(8);
        
        return $timestamp . '_' . $random . '.' . $extension;
    }

    private function cleanFileName(string $originalName): string
    {
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        return Str::title(str_replace(['_', '-'], ' ', $name));
    }

    private function extractMetadata(UploadedFile $file, string $storedPath): array
    {
        $metadata = [];
        
        if (str_starts_with($file->getMimeType(), 'image/')) {
            $fullPath = Storage::disk('public')->path($storedPath);
            
            if (file_exists($fullPath)) {
                $imageInfo = getimagesize($fullPath);
                if ($imageInfo !== false) {
                    $metadata['width'] = $imageInfo[0];
                    $metadata['height'] = $imageInfo[1];
                    $metadata['type'] = $imageInfo['mime'];
                }
            }
        }
        
        return $metadata;
    }

    private function bulkDelete(array $mediaIds): int
    {
        $media = Media::whereIn('id', $mediaIds)->get();
        
        foreach ($media as $item) {
            if (Storage::disk('public')->exists($item->path)) {
                Storage::disk('public')->delete($item->path);
            }
            $item->delete();
        }

        return $media->count();
    }

    private function bulkChangeCategory(array $mediaIds, ?int $categoryId): int
    {
        return Media::whereIn('id', $mediaIds)
            ->update(['media_category_id' => $categoryId]);
    }

    private function getMediaStats(): array
    {
        $totalMedia = Media::count();
        $totalSize = Media::sum('size');
        $categoriesCount = MediaCategory::active()->count();
        $recentUploads = Media::where('created_at', '>=', now()->subDays(7))->count();
        
        return [
            'total_media' => $totalMedia,
            'total_size' => $totalSize,
            'total_size_formatted' => $this->formatBytes($totalSize),
            'categories_count' => $categoriesCount,
            'recent_uploads' => $recentUploads,
        ];
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes === 0) return '0 B';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}