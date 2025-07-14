<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use hasFactory;
    protected $table = 'campaign';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'type_campaign_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_id' => 'integer',
        'type_campaign_id' => 'integer',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type_campaign()
    {
        return $this->belongsTo(TypeCampaign::class, 'type_campaign_id');
    }
}
