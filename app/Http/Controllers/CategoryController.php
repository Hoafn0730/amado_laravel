<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.pages.category.show', ['categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Category::create([

                'name' => $request->name, 
                'slug' => Str::slug($request->name),
                'image' => $request->image,
            ]);
            
            return redirect()->back()
            ->with('success', 'Tạo thành công');
        } catch (\Throwable $th) {
            return  redirect()->back()->withErrors('Thông tin bạn nhập đã tồn tại!'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', ['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Category::find($id)->update([ 
                'name' => $request->name, 
                'slug' => Str::slug($request->name),
                'image' => $request->image,
            ]);
            
            return  redirect('/categories')
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()
        ->with('success', 'Xoá thành công');
    }
}