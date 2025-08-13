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

    public $timestamps = false;

    public const CREATED_AT = 'created_at';

    protected $fillable = [
        'content',
        'campaign_id',
    ];

    protected $casts = [
        'id' => 'string',
        'content' => 'string',
        'campaign_id' => 'string',
        'created_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
