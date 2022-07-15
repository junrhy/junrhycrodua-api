<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [
        'long_name',
        'short_name',
        'properties'
    ];
}
