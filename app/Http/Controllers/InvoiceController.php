<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $user_id = 1;
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
        ->select('orders.*', 
        DB::raw('(
            SELECT JSON_ARRAYAGG(
                JSON_OBJECT("product_id", products.id, "product_name", products.name, "product_price", products.price, "quantity", order_product.quantity)
            )
            FROM order_product
            JOIN products ON order_product.product_id = products.id
            WHERE order_product.order_id = orders.id
        ) AS products'), 
        'users.name as user_name')
        ->where('orders.user_id', '=', $user_id)
        ->get();
        
        return view('pages.invoice', ['orders'=> $orders]);
    }

}