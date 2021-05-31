<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\User;
use App\Konfirmasi;
use App\Pesanan;

class KonfirmasiAdmController extends Controller
{
    public function index()
    {
    	$title = 'List Konfirmasi Pembayaran';
    	$konfirmasis = Konfirmasi::orderBy('id', 'desc')->get();
    	
    	return view('admin.konfirmasi-admin', compact('title', 'konfirmasis'));
    }

    public function detail($id)
    {
    	$hasilArray = array('product'=>array());

    	$pesanan = Pesanan::where('id', $id)->first();
    	$hasilArray['nama_penerima'] = $pesanan->nama_penerima;
    	$hasilArray['alamat'] = $pesanan->alamat;

    	$products = Pesanan_product::where('id', $id)->get();

    	foreach ($products as $key => $product) {
    		$barangArray = array();
    		$barangArray['nama_product'] = $product->product['product_name'];
    		$barangArray['qty'] = $product->qty;
    		$barangArray['subtotal'] = number_format($product->subtotal, 0);

    		array_push($hasilArray['product'], $barangArray);
    	}

    	return response()->json([
    		'hasil'=>$hasilArray
    	]);
    }

    public function terima($pesanan_id)
    {
        $pesanan = Pesanan::where('id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 3;
        $pesanan->save();

        Session::flash('pesan', 'Berhasil di konfirmasi');

        return redirect('konfirmasi-admin');
    }

    public function tolak($pesanan_id)
    {
        $pesanan = Pesanan::where('id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 4;
        $pesanan->save();

        Session::flash('pesan', 'Berhasil di konfirmasi');

        return redirect('konfirmasi-admin');
    }

}
