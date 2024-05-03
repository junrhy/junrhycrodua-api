<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class State extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'country_code',
        'long_name',
        'short_name'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'long_name',
        'created_at'
    ];
}
