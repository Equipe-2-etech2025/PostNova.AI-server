<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateTag extends Model
{
    use HasFactory;

    protected $table = 'template_tags';

    protected $fillable = [
        'template_id',
        'tag',
    ];

    public function template()
    {
        return $this->belongsTo(CampaignTemplate::class, 'template_id');
    }
}
