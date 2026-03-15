<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'type', 'breed', 'gender', 'age_months',
        'weight_kg', 'size', 'status', 'description',
        'is_vaccinated', 'is_neutered', 'is_microchipped', 'is_house_trained',
        'good_with_kids', 'good_with_dogs', 'good_with_cats',
        'color', 'photo', 'intake_date', 'shelter_id',
    ];

    protected $casts = [
        'is_vaccinated'    => 'boolean',
        'is_neutered'      => 'boolean',
        'is_microchipped'  => 'boolean',
        'is_house_trained' => 'boolean',
        'good_with_kids'   => 'boolean',
        'good_with_dogs'   => 'boolean',
        'good_with_cats'   => 'boolean',
        'intake_date'      => 'date',
        'weight_kg'        => 'decimal:2',
    ];

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PetPhoto::class);
    }

    public function adoptionApplications(): HasMany
    {
        return $this->hasMany(AdoptionApplication::class);
    }

    public function adoptionRecord(): HasOne
    {
        return $this->hasOne(AdoptionRecord::class);
    }

    public function medicalRecords(): HasMany
    {
        return $this->hasMany(PetMedicalRecord::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function getAgeDisplayAttribute(): string
    {
        if (!$this->age_months) return 'Unknown';
        $years  = intdiv($this->age_months, 12);
        $months = $this->age_months % 12;
        if ($years > 0 && $months > 0) return "{$years}y {$months}m";
        if ($years > 0) return "{$years} year" . ($years > 1 ? 's' : '');
        return "{$months} month" . ($months > 1 ? 's' : '');
    }

    public function getPrimaryPhotoAttribute(): ?string
    {
        return $this->photos()->where('is_primary', true)->value('path') ?? $this->photo;
    }
}