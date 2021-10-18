<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function classification(){
        return $this->belongsTo(ProductClassification::class, 'classification_id','id');
    }
}
