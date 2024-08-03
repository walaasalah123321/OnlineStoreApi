<?php 
namespace App\Http\Interfaces;
interface CartInterface{

    public function AddCart($request);
    public function DeleteFromCart($request);
    public function UpdateCart($request);
    public function UserCart();
}