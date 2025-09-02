<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\Campaign $campaign
 * @property-read \App\Models\Prompt $prompt
 */
class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'path',
        'is_published',
        'campaign_id',
        'prompt_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'path' => 'string',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'campaign_id' => 'integer',
        'prompt_id' => 'integer',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function prompt()
    {
        return $this->belongsTo(Prompt::class, 'prompt_id', 'id');
    }
}
