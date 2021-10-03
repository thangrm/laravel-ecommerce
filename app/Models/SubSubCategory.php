<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
            'subcategory_id',
            'subsubcategory_name_en',
            'subsubcategory_name_vn',
            'subsubcategory_slug_en',
            'subsubcategory_slug_vn',
    ];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
