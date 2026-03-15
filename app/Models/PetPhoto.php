<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'path', 'is_primary'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function setPrimaryAttribute(bool $value): void
    {
        if ($value) {
            static::where('pet_id', $this->pet_id)
                ->where('id', '!=', $this->id)
                ->update(['is_primary' => false]);
        }
        $this->attributes['is_primary'] = $value;
    }
}