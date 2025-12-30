<?php

namespace App\Http\Controllers;

use App\Contract\CartServiceInterface;

class CartController extends Controller
{
    public function index(CartServiceInterface $cartService)
    {
        $cart = $cartService->all();
        return view('pages.cart', ['cart' => $cart]);
    }
}
