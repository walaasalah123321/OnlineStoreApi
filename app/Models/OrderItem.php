<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    protected $fillable=["order_id","Product_id","count","unit_price","total_price"];

    use HasFactory;
}
