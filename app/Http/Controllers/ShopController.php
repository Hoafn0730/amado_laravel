<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug = null)
    {
        $categories = Category::all();
        // $brands = $request->query('brands');
        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.*')
        ->where('categories.slug', '=', $slug)->paginate(8);
        
        if ($slug === null) {
            if ($categories->count() > 0) {
                $slug = $categories[0]->slug;
                return redirect('/shop/'.$slug);
            }
        }

        return view('pages.shop', [
            'categories'=> $categories, 
            'products' => $products,
            'categoryCurrent' => $slug,
            // 'brands' => $brands
        ]);
    }

    
}