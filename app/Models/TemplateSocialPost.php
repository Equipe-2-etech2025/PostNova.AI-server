<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSocialPost extends Model
{
    use HasFactory;

    protected $table = 'template_social_posts';

    protected $fillable = [
        'content',
        'social_id',
        'template_id',
    ];

    public function social()
    {
        return $this->belongsTo(Social::class, 'social_id');
    }

    public function template()
    {
        return $this->belongsTo(CampaignTemplate::class, 'template_id');
    }
}
