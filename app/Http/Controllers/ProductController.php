<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();
        return view('admin.pages.product.show', ['products'=> $products, 'categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'details' => $request->details,
                'price' => $request->price,
                'image' => $request->image,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
        
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Throwable $th) {
            //throw $th;
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.pages.product.edit', ['product'=> $product, 'categories'=> $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id )
    {
        try {
            Product::find($id)->update([ 
                'name' => $request->name, 
                'slug' => Str::slug($request->name),
                'details' => $request->details, 
                'price' => $request->price, 
                'image' => $request->image, 
                'quantity' => $request->quantity, 
                'description' => $request->description, 
                'category_id' => $request->category_id, 
            ]);
        
            return  redirect('/products')
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
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back() 
        ->with('success', 'Xoá thành công');
    }
}