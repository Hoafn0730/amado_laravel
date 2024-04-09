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
        $brands = $request->query('brands');
        $products = null;

        if ($slug === null) {
            if ($categories->count() > 0) {
                $slug = $categories[0]->slug;
                return redirect('/shop/'.$slug);
            }
        }
    

        return view('pages.shop', [
            'categories'=> $categories, 
            'products' => '',
            'categoryCurrent' => $slug,
            'brands' => $brands
        ]);
    }

    
}