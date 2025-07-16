<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    use HasFactory;

    protected $table = 'features';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
    ];

}
