<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Product;

class UserController extends Controller
{
    public function index(){
        //Menampilkan halaman depan dan 3 produk terbaru
        $products= Product::with('RelasiProductCategory','RelasiProductImage')->orderBy('id','desc')->take(3)->get();
        return view ('user.index',compact(['products']));
    }

    public function showAll(){
        //Menampilkan semua produk yang ada
        $products= Product::with('RelasiProductCategory','RelasiProductImage')->get();
        return view ('user.show_all',compact(['products']));
    }

    public function detail($id){
        //Menampilkan produk yang dipilih
        $product= Product::with('RelasiProductCategory','RelasiProductImage')->where('id',$id)->first();
        return view ('user.detail',compact(['product']));
    }

    public function logout(Request $request){
        // $request->session()->flush();
        Auth::logout();
        return redirect('/user');
    }
    public function transaksiLangsung($id){
        $product= Product::with('RelasiProductCategory','RelasiProductImage')->where('id',$id)->first();
        return view ('user.transaksi-langsung',compact(['product']));
    }
}