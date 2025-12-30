<?php

namespace App\Http\Controllers;

use App\Data\ProductData;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = ProductData::collect(
            Product::latest()->limit(3)->get()
        );

        $latestProducts = ProductData::collect(
            Product::latest()->limit(3)->get()
        );

        return view('pages.homepage', compact('featuredProducts', 'latestProducts'));
    }
}
