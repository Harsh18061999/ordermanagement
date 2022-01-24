<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\AddToCart;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function all(){
        $brands = Brand::with('product')->get()->toArray();
        $addtocartList = AddToCart::with('product')->get()->toArray();
        // dd($addtocartList);
        return view('brand',compact('brands','addtocartList'));
    }
}
