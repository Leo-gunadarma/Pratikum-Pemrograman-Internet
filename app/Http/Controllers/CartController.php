<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Product;
use App\City;
use App\Pesanan;
use App\Pesanan_product;

use Cart;

class CartController extends Controller
{
    public function index()
    {
    	$title = 'Shopping Cart';
    	$products = Cart::content();
        $provinsi = $this->get_provinsi();

        $alamat = City::first();
        $kota_asal = $alamat->city_name;
    	// dd($provinsi);

    	return view('shop.shopping_cart', compact('products', 'provinsi', 'kota_asal'));
    }

    public function get_ongkir($asal,$tujuan,$kurir,$berat)
    {
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=$kurir",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 0f1ebdbabb0d64fe3ee23c118ac79b73"
          ),
        ));
         
        $response = curl_exec($curl);
        $err = curl_error($curl);
         
        curl_close($curl);
         
        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
          // echo $response;
        }

         return response()->json([
            'data'=>json_decode($response)
        ]);
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

    public function get_provinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 0f1ebdbabb0d64fe3ee23c118ac79b73"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

        } else {

        }

        return json_decode($response);
    }

    public function get_kota_ajax($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$provinsi",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 0f1ebdbabb0d64fe3ee23c118ac79b73"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
          // echo $response;
        }

        return response()->json([
            'data'=>json_decode($response)
        ]);
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
