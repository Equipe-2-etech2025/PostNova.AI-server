<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\Campaign $campaign
 */
class Prompt extends Model
{
    use HasFactory;

    protected $table = 'prompts';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'content',
        'campaign_id',
    ];

    protected $casts = [
        'id' => 'string',
        'content' => 'string',
        'campaign_id' => 'string',
        
        'business_name' => 'string',
        'email' => 'string',
        'phone_numbers' => 'array',
        'company' => 'string',
        'website' => 'string',
        'industry' => 'string',
        'location' => 'string',
        'target_audience' => 'string',
        'goals' => 'string',
        'budget' => 'string',
        'keywords' => 'array',
        'additional_notes' => 'string',
        'preferred_style' => 'string',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
