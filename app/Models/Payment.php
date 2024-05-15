<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Payment extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [

    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];
}
