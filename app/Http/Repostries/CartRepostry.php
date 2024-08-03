<?php 
namespace App\Http\Repostries;
use App\Models\Cart;
use App\Rules\CountCartRule;
use App\Rules\UpdateCartRule;
use App\Http\Trait\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\CartInterface;
use Illuminate\Support\Facades\Validator;

class CartRepostry implements CartInterface{
    use ApiResponse;
    public function AddCart($request){
        $validator=Validator::make($request->all(),[
            "Product_id"=>"required|exists:products,id",
            "count"=>["required ", new CountCartRule]
        ]);
        if($validator->fails()){
          return   $this->ApiResponse("400","failed add to cart",null,$validator->errors());

        }
        $cart=Cart::where([["User_id",Auth::user()->id],["Product_id",$request->Product_id]])->first();
        if($cart){        
            $cart->update([
                "count" => $request->count + $cart->count
            ]);
        }
        else{
        
        $cart=Cart::create(
            [
                "User_id"=>Auth::user()->id,
                "Product_id"=>$request->Product_id,
                "count"=>$request->count,
            ]
            
            );
        }
           return  $this->ApiResponse(200,"add to cart successfully",null,$cart);

    }
    public function DeleteFromCart($request){

        // $validator=Validator::make($request->all(),[
        //     "id"=>"required|exists:carts,id",
        // ]);
        $cart=Cart::where("id",$request->id);

        if(!$cart){
          return   $this->ApiResponse("400","cart no found",null,);

        }
      
        $cart->delete();
        return  $this->ApiResponse(200,"delete cart successfully",null);
    }
    public function UpdateCart($request){
        
        $validator=Validator::make($request->all(),[
            "Product_id"=>"required|exists:products,id",
            "count"=>["required ", new UpdateCartRule]
        ]);
        if($validator->fails()){
          return   $this->ApiResponse("400","failed add to cart",null,$validator->errors());

        }
        $cart=Cart::where([["User_id",Auth::user()->id],["Product_id",$request->Product_id]])->first();
        $cart->update( [ 
            "count"=>$request->count,
        ]);
        return $this->ApiResponse(200,"update Successfully ");
        
        
    }
    public function UserCart(){
        $UserCart= DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.Product_id')
        ->select('carts.id','User_id', 'count', 'products.name as Product Name')->get();
        // $UserCart=Cart::where("User_id",Auth::user()->id)->select('User_id',"count")->with('Product')->get();
        return $this->ApiResponse(200,"all User Cart",null,$UserCart);

    }
}