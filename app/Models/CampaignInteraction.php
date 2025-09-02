<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CampaignInteraction
 *
 * @property int $id
 * @property int $user_id
 * @property int $campaign_id
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * Relations
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Campaign $campaign
 */
class CampaignInteraction extends Model
{
    use HasFactory;

    protected $table = 'campaign_interactions';

    protected $fillable = [
        'user_id',
        'campaign_id',
        'views',
        'likes',
        'shares',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
