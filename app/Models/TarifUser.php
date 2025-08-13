<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifUser extends Model
{
    use HasFactory;

    protected $table = 'tarif_users';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = false;

    public const CREATED_AT = 'created_at';

    protected $fillable = [
        'tarif_id',
        'user_id',
        'expired_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'tarif_id' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
