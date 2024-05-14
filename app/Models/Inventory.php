<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Inventory extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'item_id',
        'qty',
        'unit',
        'operator'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];

    /**
     * Get items
     */
    public function item(): BelongsTo
    {
        return $this->BelongsTo(Item::class);
    }
}
