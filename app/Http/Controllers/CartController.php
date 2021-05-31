<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Product;
use App\Pesanan;
use App\Pesanan_product;

use Cart;

class CartController extends Controller
{
    public function index()
    {
    	$title = 'Shopping Cart';
    	$products = Cart::content();
    	// dd($barangs);

    	return view('shop.shopping_cart', compact('products'));
    }

    public function destroy()
    {
    	Cart::destroy();
    	Session::flash('pesan', 'Keranjang Berhasil Dikosongkan');

    	return redirect('shopping-cart');
    }

    public function tambahkan($rowId)
    {
    	$item = Cart::get($rowId);
    	Cart::update($rowId, ['qty'=>$item->qty + 1]);

    	return redirect()->back();
    }

    public function kurangi($rowId)
    {
    	$item = Cart::get($rowId);
    	Cart::update($rowId, ['qty'=>$item->qty - 1]);

    	return redirect()->back();
    }

    public function checkout()
    {
    	return view('shop.checkout');
    }

    public function bayar(Request $request)
    {
    	$users_id = Auth::user()->id;
    	$nama_penerima = $request->nama_penerima;
    	$alamat = $request->alamat;
    	$total_bayar = 0;

    	$keranjang = Cart::content();
    	foreach ($keranjang as $cart) {
    		$total_bayar += $cart->subtotal;
    	}

    	$pesanan = new Pesanan;
    	$pesanan->users_id = $users_id;
    	$pesanan->nama_penerima = $nama_penerima;
    	$pesanan->alamat = $alamat;
    	$pesanan->total_bayar = $total_bayar;
    	$pesanan->save();

    	foreach ($keranjang as $cart) {
    		$pesan_barang = new Pesanan_product;
    		$pesan_barang->pesanan_id = $pesanan->id;
    		$pesan_barang->product_id = $cart->id;
    		$pesan_barang->qty = $cart->qty;
    		$pesan_barang->subtotal = $cart->subtotal;
    		$pesan_barang->save();
    	}

    	// Cart::destroy();

    	return redirect('/invoice');
    }
}
