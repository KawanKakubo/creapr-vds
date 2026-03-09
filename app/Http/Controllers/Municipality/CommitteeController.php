<?php

namespace App\Http\Controllers\Municipality;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitteeController extends Controller
{
    /**
     * Adicionar membro ao comitê
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $submission = $user->submission;
        
        // Verifica se não excede 5 membros
        if (!CommitteeMember::canAddMember($submission->id)) {
            return response()->json([
                'success' => false,
                'message' => 'O comitê já possui 5 membros.'
            ], 422);
        }
        
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'cargo' => 'required|string|max:255',
            'orgao' => 'required|string|max:255',
        ]);
        
        $validated['submission_id'] = $submission->id;
        
        CommitteeMember::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Membro adicionado com sucesso!'
        ]);
    }
    
    /**
     * Remover membro do comitê
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $submission = $user->submission;
        
        $member = CommitteeMember::where('submission_id', $submission->id)
            ->where('id', $id)
            ->firstOrFail();
        
        $member->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Membro removido com sucesso!'
        ]);
    }
}
