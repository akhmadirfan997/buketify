<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->paginate(12);
        return view('buyer.dashboard', compact('products'));
    }
} 