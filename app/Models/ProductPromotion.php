<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'promotion_id'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function promotion() {
        return $this->belongsTo(Promotion::class);
    }
}
