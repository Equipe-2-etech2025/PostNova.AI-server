<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarifs';

    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'id' => 'integer',
        'amount' => 'float',
        'max_limit' => 'integer',
    ];

    protected $fillable = [
        'name',
        'amount',
        'max_limit',
    ];
}
