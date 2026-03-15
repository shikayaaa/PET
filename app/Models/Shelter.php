<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city',
        'province', 'zip_code', 'website', 'description',
        'logo', 'is_active', 'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function adoptionApplications(): HasMany
    {
        return $this->hasMany(AdoptionApplication::class);
    }

    public function adoptionRecords(): HasMany
    {
        return $this->hasMany(AdoptionRecord::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}