<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'status', 
        'amount',
        'payment_method',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
