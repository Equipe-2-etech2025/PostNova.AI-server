<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCampaign extends Model
{
    use HasFactory;

    protected $table =  'type_campaign';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = [
        'name',
        'date_created_at',
        'date_update_at',
    ];
    public $timestamps = false;
}
