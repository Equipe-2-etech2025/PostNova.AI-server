<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifUser extends Model
{
    use HasFactory;

    protected $table = 'tarif_user';

    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'tarif_id',
        'user_id',
        'date_created_at',
        'expired_at',
    ];

    public $timestamps = false;

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
