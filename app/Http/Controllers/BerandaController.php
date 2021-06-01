<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Product;
use Cart;

class BerandaController extends Controller
{
    public function index()
    {
    	$products = Product::orderBy('id','desc')->where('status_id', 1)->get();

    	return view('welcome', compact('products'));
    }

    public function detail($id)
    {
    	$product = Product::where('id', $id)->first();

    	return view('user.detail', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
    	$product = Product::find($id);
    	Cart::add(['id'=>$product->id, 'name'=>$product->product_name, 'qty'=>1, 'price'=>$product->price]);

        Session::flash('pesan', 'Barang berhasil di masukkan ke keranjang');

    	// $request->session()->put('cart', $cart);
    	// dd($request->session()->get('cart'));
        // dd(Cart::content());
    	return redirect()->back();
    }

    public function category($id)
    {
    	$products = Product::orderBy('product_name', 'asc')->where('category_id', $id)->where('status_id', 1)->get();

        return view('welcome', compact('products'));
    }

    
}
