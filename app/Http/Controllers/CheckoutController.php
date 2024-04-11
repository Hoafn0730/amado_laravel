<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function view() {
        return view('pages.checkout');
    }

    public function store(Request $request) {
        try {
 
            $data = $request->all();
            $data['user_id'] = 1;
            $data['name_on_card'] = $request->first_name.' '.$request->last_name;
            if ($request->discount_code) {
                $data['discount'] = 1;
            }
            if ($request->cod === 'on') {
                # code...
                $data['payment_gateway'] = 'cod';
            } else if ($request->paypal === 'on' ) {
                # code...
                $data['payment_gateway'] = 'paypal';
            }
            $data['total'] = $request->cart['totalPrice'];

            $order = Order::create($data);
            $orderId = $order->id;
            $data_products = $request->cart['items'];
            foreach ($data_products as $item) {
                OrderProduct::create([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            session()->forget('cart');
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'.$e->getMessage()); 
        }
        
    }

    
}