<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SocialPost extends Model
{
    use HasFactory;

    protected $table = 'social_post';

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'content',
        'social_id',
    ];

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_id');
    }
}
