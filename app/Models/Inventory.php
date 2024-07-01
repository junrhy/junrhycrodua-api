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
        'name',
        'item_code',
        'currency',
        'price',
        'qty',
        'unit',
        'status'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];
}
