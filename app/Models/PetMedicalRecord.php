<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetMedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pet_id', 'record_type', 'title', 'description',
        'veterinarian_name', 'clinic_name', 'date',
        'next_due_date', 'cost', 'medicine_given',
        'dosage', 'status', 'attachment', 'recorded_by',
    ];

    protected $casts = [
        'date'          => 'date',
        'next_due_date' => 'date',
        'cost'          => 'decimal:2',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function scopeVaccinations($query)
    {
        return $query->where('record_type', 'vaccination');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('next_due_date', '>=', now())
                     ->where('status', 'scheduled')
                     ->orderBy('next_due_date');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function isDue(): bool
    {
        return $this->next_due_date && $this->next_due_date->isPast();
    }

    public function getDaysUntilDueAttribute(): ?int
    {
        if (!$this->next_due_date) return null;
        return now()->diffInDays($this->next_due_date, false);
    }
}