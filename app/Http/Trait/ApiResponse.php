<?php 
namespace App\Http\Trait;
trait ApiResponse{
function  ApiResponse($code=200,$massage=null,$error=null,$data=null){
    $array=[
        "status"=>$code,
        "message"=>$massage,
    ];
    if(is_null($data) && !is_null($error)){
        $array["error"]=$error;
    }
    elseif  (!is_null($data)&& is_null($error)){
        $array["data"]=$data;
    }
    else{
        $array["error"]=$error;
        $array["data"]=$data;

    }
    return response($array,200);
}


}