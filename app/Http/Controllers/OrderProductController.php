<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
   
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = OrderProduct::join('products','order_product.product_id', '=', 'products.id')
            ->select('order_product.*', 'products.id', 'products.name', 'products.price')
            ->where('order_id', '=' , $id)->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return   response()->json($e->getMessage());
        }
       
    }

    
    public function store(Request $request)
    {
        try {
           
            OrderProduct::create($request->all());

            $product = Product::find($request->product_id);
            
            $total = $product->price * $request->quantity;
            $order = Order::find($request->order_id);
            
            if ($order->discount) {
                $total = $total - $total * 0.15;
            }

            $order->update([ 
                'total' => $total,
            ]);
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'.$e->getMessage()); 
        }
       
    }

  
}