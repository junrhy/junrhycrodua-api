<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Sale extends Model
{
    use HasFactory, AsSource, Filterable;

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

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];
}
