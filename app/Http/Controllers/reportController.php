<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Pesanan_product;
use Illuminate\Support\Facades\DB;

class reportController extends Controller
{
    public function index()
    {
    	$report_graphic = Pesanan::selectRaw("tanggal, SUM(total_bayar) AS totally")->where('status_invoice_id','=','3')->whereNotNull('tanggal')->groupBy(DB::raw('MONTH(tanggal), YEAR(tanggal)'))->get();
    	$report_graphic1 = Pesanan::selectRaw("tanggal, SUM(total_bayar) AS totally")->where('status_invoice_id','=','3')->whereNotNull('tanggal')->groupBy(DB::raw('YEAR(tanggal)'))->get();
    	/*$report_month = Pesanan::where('status_invoice_ids','=','3')->whereMonth('tanggal','=','MONTH(NOW())')->whereYear('tanggal','=','YEAR(NOW())')->sum('total_bayar');
    	$report_year = Pesanan::where('status_invoice_ids','=','3')->whereYear('tanggal','=','YEAR(NOW())')->sum('total_bayar');
    	$pendapatan_bulanan = $report_month;
    	$pendapatan_tahunan = $report_year;
    	*/
    	return view('admin.report', compact('report_graphic','report_graphic1'));
    }

	public function dashboard()
    {
    	return view('admin.dashboard-admin');
    }
}
