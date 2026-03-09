<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * Display a listing of the questions with filters
     */
    public function index(Request $request)
    {
        $query = DiagnosticQuestion::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status (active/inactive)
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        // Order by category and order
        $questions = $query->orderBy('category')
                          ->orderBy('order')
                          ->paginate(20)
                          ->withQueryString();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new question
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created question in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:estimulo,educacao,estruturas',
            'question' => 'required|string|max:1000',
            'type' => 'required|in:yes_no,yes_no_evidence,checkbox,multiple_input,text',
            'options' => 'nullable|array',
            'options.*' => 'required|string|max:255',
            'requires_evidence' => 'boolean',
            'order' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:500',
        ]);

        // Convert options to null if empty
        if (empty($validated['options'])) {
            $validated['options'] = null;
        }

        // Validate that checkbox and multiple_input types have options
        if (in_array($validated['type'], ['checkbox', 'multiple_input'])) {
            if (empty($validated['options']) || count($validated['options']) < 2) {
                return back()->withErrors(['options' => 'Tipos checkbox e multiple_input precisam de pelo menos 2 opções.'])->withInput();
            }
        }

        // Set defaults
        $validated['requires_evidence'] = $request->has('requires_evidence');
        $validated['is_active'] = $request->has('is_active');

        try {
            DiagnosticQuestion::create($validated);
            
            Log::info('Questão diagnóstica criada', [
                'category' => $validated['category'],
                'type' => $validated['type'],
                'order' => $validated['order']
            ]);

            return redirect()->route('admin.questions.index')
                           ->with('success', 'Questão criada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar questão: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erro ao criar questão. Tente novamente.'])->withInput();
        }
    }

    /**
     * Show the form for editing the specified question
     */
    public function edit(DiagnosticQuestion $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified question in database
     */
    public function update(Request $request, DiagnosticQuestion $question)
    {
        $validated = $request->validate([
            'category' => 'required|in:estimulo,educacao,estruturas',
            'question' => 'required|string|max:1000',
            'type' => 'required|in:yes_no,yes_no_evidence,checkbox,multiple_input,text',
            'options' => 'nullable|array',
            'options.*' => 'required|string|max:255',
            'requires_evidence' => 'boolean',
            'order' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:500',
        ]);

        // Convert options to null if empty
        if (empty($validated['options'])) {
            $validated['options'] = null;
        }

        // Validate that checkbox and multiple_input types have options
        if (in_array($validated['type'], ['checkbox', 'multiple_input'])) {
            if (empty($validated['options']) || count($validated['options']) < 2) {
                return back()->withErrors(['options' => 'Tipos checkbox e multiple_input precisam de pelo menos 2 opções.'])->withInput();
            }
        }

        // Set defaults
        $validated['requires_evidence'] = $request->has('requires_evidence');
        $validated['is_active'] = $request->has('is_active');

        try {
            $question->update($validated);
            
            Log::info('Questão diagnóstica atualizada', [
                'id' => $question->id,
                'category' => $validated['category'],
                'type' => $validated['type']
            ]);

            return redirect()->route('admin.questions.index')
                           ->with('success', 'Questão atualizada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar questão: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erro ao atualizar questão. Tente novamente.'])->withInput();
        }
    }

    /**
     * Remove (deactivate) the specified question
     */
    public function destroy(DiagnosticQuestion $question)
    {
        try {
            // Instead of deleting, we deactivate the question
            $question->update(['is_active' => false]);
            
            Log::info('Questão diagnóstica desativada', ['id' => $question->id]);

            return redirect()->route('admin.questions.index')
                           ->with('success', 'Questão desativada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao desativar questão: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erro ao desativar questão. Tente novamente.']);
        }
    }

    /**
     * Reorder questions within a category
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:diagnostic_questions,id',
            'questions.*.order' => 'required|integer|min:1',
        ]);

        try {
            foreach ($validated['questions'] as $questionData) {
                DiagnosticQuestion::where('id', $questionData['id'])
                                ->update(['order' => $questionData['order']]);
            }

            Log::info('Questões reordenadas', ['count' => count($validated['questions'])]);

            return response()->json(['success' => true, 'message' => 'Ordem atualizada com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao reordenar questões: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erro ao atualizar ordem.'], 500);
        }
    }

    /**
     * Toggle active status for multiple questions
     */
    public function bulkToggle(Request $request)
    {
        $validated = $request->validate([
            'question_ids' => 'required|array',
            'question_ids.*' => 'required|exists:diagnostic_questions,id',
            'action' => 'required|in:activate,deactivate',
        ]);

        try {
            $isActive = $validated['action'] === 'activate';
            
            DiagnosticQuestion::whereIn('id', $validated['question_ids'])
                            ->update(['is_active' => $isActive]);

            $action = $isActive ? 'ativadas' : 'desativadas';
            $count = count($validated['question_ids']);

            Log::info("Questões {$action} em lote", ['count' => $count]);

            return redirect()->route('admin.questions.index')
                           ->with('success', "{$count} questão(ões) {$action} com sucesso!");
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar questões em lote: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Erro ao atualizar questões. Tente novamente.']);
        }
    }
}
