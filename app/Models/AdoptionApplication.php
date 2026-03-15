<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdoptionApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'pet_id', 'shelter_id', 'status',
        'reason', 'home_type', 'has_yard', 'has_other_pets',
        'other_pets_details', 'has_children', 'children_ages',
        'previous_pet_experience', 'reviewer_notes',
        'reviewed_by', 'reviewed_at',
    ];

    protected $casts = [
        'has_yard'       => 'boolean',
        'has_other_pets' => 'boolean',
        'has_children'   => 'boolean',
        'reviewed_at'    => 'datetime',
    ];

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function adoptionRecord(): HasOne
    {
        return $this->hasOne(AdoptionRecord::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function approve(int $reviewerId): void
    {
        $this->update([
            'status'      => 'approved',
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
        ]);

        $this->pet->update(['status' => 'pending']);
    }

    public function reject(int $reviewerId, ?string $notes = null): void
    {
        $this->update([
            'status'         => 'rejected',
            'reviewed_by'    => $reviewerId,
            'reviewed_at'    => now(),
            'reviewer_notes' => $notes,
        ]);

        $this->pet->update(['status' => 'available']);
    }
}