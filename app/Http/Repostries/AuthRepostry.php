<?php
namespace App\Http\Repostries;

use App\Models\User;
use App\Rules\EmailRule;
use App\Http\Trait\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthRepostry implements AuthInterface{
    use ApiResponse;
    public function Register($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required',new EmailRule()],
            'password' => 'required|min:8',
        ]);
        if($validator->fails()){
            return $this->ApiResponse(400,"failed create Acount",$validator->errors());
        }
        else{
           User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),

        ]);
        return $this->ApiResponse(200,"success create Acount");
    }
     
    }
    public function Login($request){

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => 'required|min:8',
        ]);
        if($validator->fails()){
            return $this->ApiResponse(400,"failed create Acount",$validator->errors());
        }
        if($token=Auth()->attempt($request->only("email","password"))){

            return $this->WithToken($token);
        }
        else{
        return $this->ApiResponse(400,"No Acount Found ");
            
        }
    }
    public function logout($request){
        JWTAuth::invalidate($request->token);
        return $this->ApiResponse("200","logout successfully");
        
    }
    public function refresh($request){
      $user=  JWTAuth::refresh($request->token);
      if(!$user){
        return $this->ApiResponse(200,"errer of refresh token ");
      }
      return $this->ApiResponse(200,"refresh sucessfully",null,$user);
        
    }
    protected function WithToken($token){
        $array=[
            "access_token"=>$token,
            "expire"=>auth()->Factory()->getTTL()*60,
        ];
        return $this->ApiResponse(200,"successfully login ",null,$array);
 
    }
   
}