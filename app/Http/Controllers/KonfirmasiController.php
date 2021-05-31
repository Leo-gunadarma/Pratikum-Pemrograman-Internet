<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\User;
use App\Konfirmasi;
use App\Pesanan;

class KonfirmasiController extends Controller
{
    public function index()
    {
    	return view('konfirmasi.konfirmasi_index');
    }

    public function store(Request $request)
    {
    	$users_id = Auth::user()->id;
    	$pesanan_id = $request->pesanan_id;

    	if($files=$request->file('photo')){
            $name=$files->getClientOriginalName();
            $files->move('image',$name);

            // base64 encode
            $base64 = base64_encode(asset('image/'.$name));
            $base = new Konfirmasi;
            $base->users_id = $users_id;
            $base->pesanan_id = $pesanan_id;
            $base->photo = $base64;
            $base->save();
        }

        $pesanan = Pesanan::where('id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 2;
        $pesanan->save();

        Session::flash('pesan', 'Data berhasil di Input');

        return redirect('invoice/list');


    }
}
