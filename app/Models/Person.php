<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereBetween;

class Person extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'properties'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'first_name'    => Like::class,
        'last_name'    => Like::class,
        'created_at'    => WhereBetween::class,
    ];

    /**
     * @var array
     */
    protected $filtersApply = [
        'first_name',
        'last_name',
        'created_at'
    ];
}
