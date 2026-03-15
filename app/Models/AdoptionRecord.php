<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'adoption_application_id',
        'pet_id', 'user_id', 'shelter_id',
        'adoption_date', 'adoption_fee',
        'payment_status', 'contract_number',
        'notes', 'contract_file', 'processed_by',
    ];

    protected $casts = [
        'adoption_date' => 'date',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(AdoptionApplication::class, 'adoption_application_id');
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('adoption_date', now()->month)
                     ->whereYear('adoption_date', now()->year);
    }

    public static function generateContractNumber(): string
    {
        return 'ADOPT-' . strtoupper(uniqid());
    }
}