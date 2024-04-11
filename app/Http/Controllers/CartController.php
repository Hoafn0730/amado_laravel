<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller{
    
    public function addToCart(Product $product,Cart $cart){
        $quantity = request('quantity',1);
        $quantity = $quantity > 0 ? floor($quantity) : 1;
        $cart->add($product,$quantity);
        return redirect('/cart')->with('success','Add to card success');
    }
    
    public function deleteToCart($id,Cart $cart){
        $cart->delete($id);
        return redirect('/cart')->with('warning','Delete success');
    }

    public function updateToCart($id,Cart $cart){
        $quantity = request('quantity',1);
        $quantity = $quantity > 0 ? floor($quantity) : 1;
        $cart->update($id,$quantity);
        return redirect('/cart')->with('success','Updated success');
    }

    public function view(){
        return view('pages.cart');
    }

}