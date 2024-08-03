<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    protected $fillable=["User_id","Product_id",'count'];
    use HasFactory;
    public function Product()  {
        return $this->belongsTo(Product::class,"Product_id","id");
        
    }
}
