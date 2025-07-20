<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignFeatures extends Model
{
    use hasFactory;

    protected $table = 'campaign_features';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'campaign_id',
        'feature_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'campaign_id' => 'integer',
        'feature_id' => 'integer',
    ];
}
