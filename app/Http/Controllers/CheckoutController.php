<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

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
           
            // Check payment gateway
            if ($request->cod === 'on') {
                $data['payment_gateway'] = 'cod';
            } else if ($request->paypal === 'on' ) {
                $data['payment_gateway'] = 'paypal';
            }
            // chưa làm: Nếu tồi tại discount thì check loại discount và giảm giá total
            if ($request->discount_code) {
                $data['discount'] = 1;
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
            return  redirect()->back()
            ->withErrors('Bạn đang không có sản phẩm nào trong giỏ hàng'); 
        }
        
    }

    
}