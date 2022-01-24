<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(){
        $product = Product::with('brand')->get()->toArray();
        return response([
            'product_list' => $product
        ],200);
    }
}
