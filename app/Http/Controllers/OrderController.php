<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Interfaces\CheckoutInterface;

class OrderController extends Controller
{
    protected $checkout;
    function __construct(CheckoutInterface $check)
    {
        
        $this->checkout=$check;
    }

    function Checkout(){
        
        return $this->checkout->Checkout();
    }
}
