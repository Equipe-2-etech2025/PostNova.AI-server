<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    protected $table = 'social_post';

    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'content',
        'date_created_at',
        'date_updated_at',
        'social_id',
    ];

    public $timestamps = false;

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_id');
    }
}
