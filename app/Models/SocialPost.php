<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\Campaign $campaign
 */
class SocialPost extends Model
{
    use HasFactory;

    protected $table = 'social_posts';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'content',
        'is_published',
        'social_id',
        'campaign_id',
        'prompt_id',
    ];

    protected $casts = [
        'content' => 'string',
        'id' => 'integer',
        'is_published' => 'boolean',
        'campaign_id' => 'integer',
        'social_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'prompt_id' => 'integer',
    ];

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }
}
