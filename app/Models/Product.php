<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function subSubCategory(){
        return $this->belongsTo(SubSubCategory::class,'subsubcategory_id','id');
    }

    public function classification(){
        return $this->hasMany(ProductClassification::class,'product_id','id');
    }
}
