<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'social_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_id');
    }
}
