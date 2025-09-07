<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'description',
        'customer_msisdn',
        'merchant_msisdn',
        'status',
        'server_correlation_id',
        'transaction_reference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
