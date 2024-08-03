<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Interfaces\ProductInterface;

class ProductController extends Controller
{
    public $Product;
    public function __construct(ProductInterface $Product){
        $this->Product=$Product;
    }
    public function Product(){
        return $this->Product->Product();
    }
        

}
