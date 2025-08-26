<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTemplate extends Model
{
    use HasFactory;

    protected $table = 'campaign_templates';

    protected $fillable = [
        'name',
        'description',
        'category',
        'type_campaign_id',
        'author',
        'thumbnail',
        'preview',
        'is_premium',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
    ];

    // Tags associés (plusieurs tags)
    public function tags()
    {
        return $this->hasMany(TemplateTag::class, 'template_id');
    }

    // Ratings associés
    public function ratings()
    {
        return $this->hasMany(TemplateRating::class, 'template_id');
    }

    // Utilisations associées
    public function uses()
    {
        return $this->hasMany(TemplateUse::class, 'template_id');
    }

    // Exemples de publications associés
    public function socialPosts()
    {
        return $this->hasMany(TemplateSocialPost::class, 'template_id');
    }

    // Calculer la note moyenne (helper)
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    // Nombre d'utilisations (helper)
    public function totalUses()
    {
        return $this->uses()->count();
    }

    public function typeCampaign()
    {
        return $this->belongsTo(TypeCampaign::class, 'type_campaign_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
