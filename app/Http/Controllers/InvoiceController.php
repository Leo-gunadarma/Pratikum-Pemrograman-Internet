<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use Auth;

use App\Pesanan;
use App\Konfirmasi;
use App\Pesanan_product;
use App\Status_invoice;

class InvoiceController extends Controller
{
    public function index()
    {
    	$products = Cart::content();
    	$total = Cart::pricetotal();
    	// dd($barangs);
    	Cart::destroy();
    	$users_id = Auth::user()->id;


    	return view('shop.invoice', compact('products', 'total'));
    }

    public function list()
    {
    	$users_id = Auth::user()->id;
    	$pesanans = Pesanan::where('users_id', $users_id)->orderBy('id', 'desc')->get();

    	return view('user.invoice', compact('pesanans'));
    }

    public function detail($id)
    {
        $details = Pesanan_product::where('pesanan_id', $id)->get();
        $pesanan = array();

        foreach ($details as $key => $detail) {
            $detailArray = array();
            $detailArray['nama_barang'] = $detail->product->product_name;
            $detailArray['qty'] = $detail->qty;
            $detailArray['subtotal'] = $detail->subtotal;
            array_push($pesanan, $detailArray);
        }

        return response()->json([
            'hasil'=>$pesanan
        ]);
    }

    public function delete($id)
    {
        Pesanan::find($id)->delete();
        Konfirmasi::where('pesanan_id', $id)->delete();
        Session::flash('pesan', 'Pesanan Anda Berhasil Dibatalkan !!!');


        return redirect()->back();
    }
}
