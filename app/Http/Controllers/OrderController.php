<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddToCart;
use App\Models\Order;
use DB;
use App\Models\OrderProduct;
class OrderController extends Controller
{
    public function addToCart(Request $reuest){
        // dd($reuest->all());
        AddToCart::create([
            'user_id' => 1,
            'product_id' => $reuest->get('product_id')
        ]);
        return redirect()->back()->with('success','Item added successfully to cart');
    }

    public function placeOrder(Request $reuest){
        // dd($reuest->all());
        $order = Order::create([
            'user_id' => 1,
            'total' => $reuest->product_price,
            'created_at' => date('y/m/d')
        ]);
        DB::table('order_products')->insert([
            'order_id' => $order->id,
            'product_id' => $reuest->product_id,
            'quantity' => $reuest->no_item,
            'total' => $reuest->product_price,
        ]);

        AddToCart::where('id',$reuest->cart_id)->delete();
        return redirect()->back()->with('success','order place successfully');
    }
}
