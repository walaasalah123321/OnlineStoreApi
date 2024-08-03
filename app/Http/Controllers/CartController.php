<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Interfaces\CartInterface;

class CartController extends Controller
{

    public $cart;
    function __construct(CartInterface $cart)
    {
        $this->cart=$cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cart->UserCart();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->cart->AddCart($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->cart->UpdateCart($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $cart)
    {
        return $this->cart->DeleteFromCart($cart);
    }
}
