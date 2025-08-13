<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateRating extends Model
{
    use HasFactory;

    protected $table = 'template_ratings';

    protected $fillable = [
        'template_id',
        'user_id',
        'rating',
    ];

    public function template()
    {
        return $this->belongsTo(CampaignTemplate::class, 'template_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
