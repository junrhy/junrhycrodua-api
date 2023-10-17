<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'official_id',
        'brgy_code',
        'region_code',
        'province_code',
        'municipal_code'
    ];
}
