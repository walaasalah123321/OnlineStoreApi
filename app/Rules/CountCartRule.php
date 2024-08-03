<?php

namespace App\Rules;

use Closure;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;

class CountCartRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $count=Product::where("id",request()->Product_id)->where("stock",">=",$value)->exists();
        $count=Product::where([["id",request()->Product_id],["stock",">=",$value]])->first();
        if($count){
        $cart=Cart::where([["User_id",Auth::user()->id],["Product_id",$count->id]])->first();

        if($cart){
            if($cart->count+ $value > $count->stock){
                $fail( $attribute." is ".$value +$cart->count  ." becouse you have ".$cart->count." in cart and product have ".$count->stock." in stock" );
            }
        }
        }
        
        else {
         $fail( $attribute." is ".$value ."and product have count less than in stock" );

        }
    }
}
