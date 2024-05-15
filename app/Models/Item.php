<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Item extends Model
{
    use HasFactory, HasUuids, AsSource, Filterable;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
        'item_code',
        'currency',
        'price',
        'expired_at'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];
}
