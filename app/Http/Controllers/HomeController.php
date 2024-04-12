<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->where('priority', '>', 0)->sortBy('priority');
        $categories = Category::all();
        return view('pages.home', ['products'=> $products]);
    }

    
}