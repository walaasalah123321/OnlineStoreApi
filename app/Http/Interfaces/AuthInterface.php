<?php
namespace App\Http\Interfaces;
interface AuthInterface{
    public function Register($request);
    public function Login($request);
    public function logout($request);
    public function refresh($request);

}