<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id', 'payment_method', 'payment_details', 'status'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
