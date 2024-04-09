<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // dd($product);
        return view('pages.detail', ['product'=> $product]);
    }

    
}