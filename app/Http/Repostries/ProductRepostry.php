<?php 
namespace App\Http\Repostries;
use App\Models\Product;
use App\Http\Trait\ApiResponse;
use App\Http\Interfaces\ProductInterface;

class ProductRepostry implements ProductInterface{
    use ApiResponse;
    public function Product(){
        $product=Product::get();
        return $this->ApiResponse(200,"all Product ",null,$product);
    }
}