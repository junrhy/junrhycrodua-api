<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [
        'item_id',
        'amount'
    ];

    /**
     * Get items
     */
    public function item(): BelongsTo
    {
        return $this->BelongsTo(Item::class);
    }
}
