<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Barangay extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'official_id',
        'brgy_code',
        'region_code',
        'province_code',
        'municipal_code'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'created_at'
    ];
}
