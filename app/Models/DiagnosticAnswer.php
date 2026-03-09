<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticAnswer extends Model
{
    protected $fillable = [
        'submission_id',
        'diagnostic_question_id',
        'category',
        'answer_yes_no',
        'answer_checkboxes',
        'answer_multiple_input',
        'answer_text',
        'evidence_url',
        'points_earned',
    ];

    protected $casts = [
        'answer_checkboxes' => 'array',
        'answer_multiple_input' => 'array',
        'points_earned' => 'decimal:2',
    ];

    /**
     * Get the submission that owns this answer
     */
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    /**
     * Get the question that this answer belongs to
     */
    public function question()
    {
        return $this->belongsTo(DiagnosticQuestion::class, 'diagnostic_question_id');
    }

    /**
     * Calculate and update points based on answer type
     */
    public function calculateAndSavePoints()
    {
        $question = $this->question;
        $basePoints = $question->calculatePoints();

        switch ($question->type) {
            case 'yes_no':
            case 'yes_no_evidence':
                $this->points_earned = $this->answer_yes_no === 'yes' ? $basePoints : 0;
                break;

            case 'checkbox':
                if (is_array($this->answer_checkboxes) && count($this->answer_checkboxes) > 0) {
                    $totalOptions = is_array($question->options) ? count($question->options) : 1;
                    $selectedCount = count($this->answer_checkboxes);
                    $this->points_earned = ($basePoints / $totalOptions) * $selectedCount;
                } else {
                    $this->points_earned = 0;
                }
                break;

            case 'multiple_input':
                // For multiple inputs, give full points if at least one field is filled
                if (is_array($this->answer_multiple_input)) {
                    $filledCount = count(array_filter($this->answer_multiple_input));
                    $this->points_earned = $filledCount > 0 ? $basePoints : 0;
                } else {
                    $this->points_earned = 0;
                }
                break;

            case 'text':
                // For text answers, give full points if not empty
                $this->points_earned = !empty($this->answer_text) ? $basePoints : 0;
                break;

            default:
                $this->points_earned = 0;
        }

        $this->save();
    }
}
