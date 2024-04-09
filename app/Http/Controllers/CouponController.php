<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.pages.coupon.show', ['coupons'=> $coupons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Coupon::create($request->all());
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Exception $e) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'.$e->getMessage()); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.pages.coupon.edit', ['coupon'=> $coupon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Coupon::find($id)->update([ 
                'name' => $request->name, 
                'slug' => $request->name, 
                'image' => $request->image,
            ]);
            
            return  redirect('/coupons')
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
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()
        ->with('success', 'Xoá thành công');
    }
}