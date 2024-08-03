<?php

namespace App\Rules;

use Closure;
use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateCartRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count=Product::where([["id",request()->Product_id],["stock",">=",$value]])->first();
        if(!$count){
            $fail( $attribute." is ".$value ."and product have count less than in stock" );

        }

    }
}
