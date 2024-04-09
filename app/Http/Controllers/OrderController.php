<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name', 'users.email')
        ->paginate(10);

        $products = Order::all();
        $users = User::all();

        return view('admin.pages.order.show', ['orders'=> $orders, 'products'=> $products, 'users'=> $users]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if ($request->discount_code) {
                $data['discount'] = 1;
            }
            Order::create($data);
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'.$e->getMessage()); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::all();
        return view('admin.pages.order.edit', ['order'=> $order, 'users'=> $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Order::find($id)->update([ 
                'name' => $request->name, 
                'slug' => Str::slug($request->name),
                'image' => $request->image,
            ]);
            
            return  redirect('/orders')
            ->with('success', 'Sửa thành công');
        } catch (\Throwable $th) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'); 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()
        ->with('success', 'Xoá thành công');
    }
}