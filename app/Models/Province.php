<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Province extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'long_name',
        'short_name',
        'properties'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'long_name',
        'created_at'
    ];
}
