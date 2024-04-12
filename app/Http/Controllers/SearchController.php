<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->query('query');
        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.*')
        ->where(function($queryBuilder) use ($query) {
        $queryBuilder->where('products.name', 'like', '%'.$query.'%')
                     ->orWhere('categories.name', 'like', '%'.$query.'%');
        })
        ->paginate(8);
        
        return view('pages.search', ['products'=> $products, 'query'=> $query]);
    }

}