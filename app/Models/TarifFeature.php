<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TarifFeature extends Model
{
    use HasFactory;

    protected $table = 'tarif_features';

    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'tarif_id',
        'name',
    ];

    protected $casts = [
        'id' => 'integer',
        'tarif_id' => 'integer',
        'name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }
}
