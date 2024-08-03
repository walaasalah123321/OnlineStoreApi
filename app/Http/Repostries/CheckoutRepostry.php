<?php 
namespace App\Http\Repostries;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Trait\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\CheckoutInterface;

class CheckoutRepostry implements CheckoutInterface{
    use ApiResponse;
public $cart;


public function __construct(Cart $cart)
{
    $this->cart=$cart;
}
public function Checkout(){
    $cartUser=$this->cart::where('User_id',Auth::user()->id)->with('Product')->get();
    if(sizeOf($cartUser)==0){
        return $this->ApiResponse(400,"No Product In Cart");
    }
    $total=0;
    foreach($cartUser as $cart){
        if($cart->count >= $cart->Product->price){

            return $this->ApiResponse(400,$cart->Product->name ."not available ,there are  ".$cart->Product->stock."is available");
        }
        $total+=$cart->Product->stock*$cart->count;
    }
    // $total=$cartUser->sum(function($q){
    //     return $q->count*$q->Product->stock;
    // });
   DB::transaction(function () use ($total ,$cartUser) {
    $order=Order::create([
        "User_id"=>Auth::user()->id,
        "total_price"=>$total
    ]);
    foreach($cartUser as $cart){
        
        OrderItem::create([
           "order_id"=>$order->id,
           "Product_id"=>$cart->Product->id,
           "count"=>$cart->count,
           "unit_price"=>$cart->Product->stock,
           "total_price"=>$cart->count*$cart->product->stock,
            
        ]);
        Product::where("id",$cart->Product->id)->update([
            "stock"=>$cart->Product->stock-$cart->count,
        ]);
        $cart->delete();
    }
   });
    return $this->ApiResponse(200,"Checkout Done Successfully");

    
    
}

}