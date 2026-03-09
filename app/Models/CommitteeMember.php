<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $fillable = [
        'submission_id',
        'nome',
        'cpf',
        'email',
        'telefone',
        'cargo',
        'orgao',
    ];

    /**
     * Get the submission that owns this committee member
     */
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    /**
     * Validation: Maximum 5 committee members per submission
     */
    public static function canAddMember($submissionId)
    {
        return static::where('submission_id', $submissionId)->count() < 5;
    }

    /**
     * Get formatted CPF
     */
    public function getFormattedCpfAttribute()
    {
        return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $this->cpf);
    }

    /**
     * Get formatted phone
     */
    public function getFormattedTelefoneAttribute()
    {
        return preg_replace('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3', $this->telefone);
    }
}
