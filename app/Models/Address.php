<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'street_name',
        'barangay_id',
        'town_id',
        'province_id',
        'country_id'
    ];
}
