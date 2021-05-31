<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Pesanan;
use App\Konfirmasi;
use App\Status_invoice;

class PesananController extends Controller
{
    public function index()
    {
    	$title = 'List Semua Pesanan';
    	$konfirmasis = Konfirmasi::orderBy('id', 'desc')->get();

    	return view('admin.pesanan', compact('title', 'konfirmasis'));
    }
}
