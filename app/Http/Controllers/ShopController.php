<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ShopController extends Controller
{
    public function index()
    {
        $products = Products::all(); // Mengambil semua produk dari database
        return view('dashboard', compact('products'));
    }
}
