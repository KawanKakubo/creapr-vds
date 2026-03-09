<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProgramEvent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'type',
        'is_published',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Scope: Only published events
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope: Upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', Carbon::today())
            ->orderBy('event_date')
            ->orderBy('event_time');
    }

    /**
     * Scope: Past events
     */
    public function scopePast($query)
    {
        return $query->where('event_date', '<', Carbon::today())
            ->orderBy('event_date', 'desc')
            ->orderBy('event_time', 'desc');
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d/m/Y');
    }

    /**
     * Get formatted time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->event_time ? $this->event_time->format('H:i') : null;
    }

    /**
     * Get event type label
     */
    public function getTypeLabel()
    {
        $types = [
            'workshop' => 'Workshop',
            'reuniao' => 'Reunião',
            'capacitacao' => 'Capacitação',
            'avaliacao' => 'Avaliação',
            'outro' => 'Outro',
        ];

        return $types[$this->type] ?? $this->type;
    }
}
