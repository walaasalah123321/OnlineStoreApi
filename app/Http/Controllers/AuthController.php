<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\EmailRule;
use Illuminate\Http\Request;
use App\Http\Trait\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $authInterface;
    function  __construct(AuthInterface $authInterface){
        $this->authInterface=$authInterface;
    }
    public function Register(Request $request){

    return $this->authInterface->Register( $request);
    }
    public function Login(Request $request){

        return $this->authInterface->Login( $request);
    }
}
