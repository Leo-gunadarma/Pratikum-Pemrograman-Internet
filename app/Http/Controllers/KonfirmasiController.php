<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin;
use App\User;
use App\Konfirmasi;
use App\Pesanan;
use App\Notifications\adminNotif;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class KonfirmasiController extends Controller
{
    public function index()
    {
    	return view('konfirmasi.konfirmasi_index');
    }

    public function store(Request $request)
    {
        $admin = Admin::all();
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
        $notif = "Pesanan baru dengan id $pesanan_id. silahkan cek kebenarannya dan berikan konfirmasi";
        $pesanan = Pesanan::where('id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 2;
        $pesanan->save();
        Notification::send($admin, new adminNotif($notif));
        Session::flash('pesan', 'Pesanan Anda segera diproses, Terimakasih telah melakukan pembayaran !');
        return redirect('invoice/list');


    }
}
