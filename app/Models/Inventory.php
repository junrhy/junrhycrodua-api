<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [

    ];

    /**
     * Get items
     */
    public function item(): BelongsTo
    {
        return $this->BelongsTo(Item::class);
    }
}
