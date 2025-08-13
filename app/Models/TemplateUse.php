<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateUse extends Model
{
    use HasFactory;

    protected $table = 'template_uses';

    public $timestamps = false; // On utilise le champ "used_at" manuellement

    protected $fillable = [
        'template_id',
        'user_id',
        'used_at',
    ];

    protected $dates = [
        'used_at',
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
