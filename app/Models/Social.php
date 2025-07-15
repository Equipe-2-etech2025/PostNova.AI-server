<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use hasFactory;

    protected $table = 'socials';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];
}
