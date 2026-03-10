<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the documents
     */
    public function index(Request $request)
    {
        $query = Repository::with('uploader')->latest();

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

        $documents = $query->paginate(15);

        return view('admin.repository.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document
     */
    public function create()
    {
        return view('admin.repository.create');
    }

    /**
     * Store a newly created document in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:oficio,decreto,lei,template,outro',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:102400', // 100MB max
            'is_active' => 'nullable|boolean',
        ]);

        // Upload file
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('repository', $filename, 'public');

        // Create record
        Repository::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'uploaded_by' => Auth::id(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.repository.index')
            ->with('success', 'Documento adicionado ao repositório com sucesso!');
    }

    /**
     * Show the form for editing the specified document
     */
    public function edit(Repository $repository)
    {
        return view('admin.repository.edit', compact('repository'));
    }

    /**
     * Update the specified document in storage
     */
    public function update(Request $request, Repository $repository)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:oficio,decreto,lei,template,outro',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:102400',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'is_active' => $request->boolean('is_active'),
        ];

        // If new file uploaded, replace old one
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($repository->file_path);

            // Upload new file
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('repository', $filename, 'public');

            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $repository->update($data);

        return redirect()->route('admin.repository.index')
            ->with('success', 'Documento atualizado com sucesso!');
    }

    /**
     * Remove the specified document from storage
     */
    public function destroy(Repository $repository)
    {
        // Delete file
        Storage::disk('public')->delete($repository->file_path);

        // Delete record
        $repository->delete();

        return redirect()->route('admin.repository.index')
            ->with('success', 'Documento removido do repositório.');
    }
}
