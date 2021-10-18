<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function detail(){
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
}
