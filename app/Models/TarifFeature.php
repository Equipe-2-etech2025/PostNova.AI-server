<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TarifFeature extends Model
{
    use HasFactory;

    protected $table = 'tarif_feature';

    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'tarif_id',
        'name',
        'date_created_at',
        'date_updated_at',
    ];

    public $timestamps = false;

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }
}
