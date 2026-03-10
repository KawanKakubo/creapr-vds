<?php

namespace App\Http\Controllers\Municipality;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
{
    /**
     * Display a listing of active documents
     */
    public function index(Request $request)
    {
        $query = Repository::active()->latest();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'ilike', "%{$request->search}%")
                  ->orWhere('description', 'ilike', "%{$request->search}%");
            });
        }

        $documents = $query->paginate(12);

        return view('municipality.repository.index', compact('documents'));
    }

    /**
     * Download a document
     */
    public function download(Repository $repository)
    {
        // Check if document is active
        if (!$repository->is_active) {
            abort(404);
        }

        // Increment download count
        $repository->incrementDownloads();

        // Return file download
        return Storage::disk('public')->download($repository->file_path, $repository->file_name);
    }
}
