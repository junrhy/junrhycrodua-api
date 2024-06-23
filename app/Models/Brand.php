<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Brand extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $keyType = 'string';
    
    protected $fillable = [
        'client_id',
        'long_name',
        'short_name',
        'properties'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'created_at'
    ];

    /**
     * Get the client that owns the brand.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
