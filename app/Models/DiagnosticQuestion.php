<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticQuestion extends Model
{
    protected $fillable = [
        'category',
        'question',
        'type',
        'options',
        'requires_evidence',
        'order',
        'is_active',
        'description',
    ];

    protected $casts = [
        'options' => 'array',
        'requires_evidence' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get all answers for this question
     */
    public function answers()
    {
        return $this->hasMany(DiagnosticAnswer::class);
    }

    /**
     * Scope: Only active questions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Filter by category and order
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category)->orderBy('order');
    }

    /**
     * Calculate points for this question based on total questions in category
     */
    public function calculatePoints()
    {
        $totalQuestions = static::active()
            ->where('category', $this->category)
            ->count();

        return $totalQuestions > 0 ? 100 / $totalQuestions : 0;
    }
}
