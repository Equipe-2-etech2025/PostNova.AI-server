<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeCampaign;
use App\Models\User;
use App\Models\Image;
use App\Models\LandingPage;
use App\Models\SocialPost;
use App\Models\CampaignInteraction;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'name',
        'status',
        'description',
        'user_id',
        'type_campaign_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'status' => 'integer',
        'description' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_id' => 'integer',
        'type_campaign_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(TypeCampaign::class, 'type_campaign_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'campaign_id');
    }

    public function landingPages()
    {
        return $this->hasMany(LandingPage::class, 'campaign_id');
    }

    public function socialPosts()
    {
        return $this->hasMany(SocialPost::class, 'campaign_id');
    }

    public function interactions()
    {
        return $this->hasMany(CampaignInteraction::class);
    }
}
