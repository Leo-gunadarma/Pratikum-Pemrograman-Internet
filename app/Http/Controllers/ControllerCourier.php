<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
//List Model Yang digunakan
use App\Courier;
class ControllerCourier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan daftar Courier
        $couriers = Courier::all();
        return view ('admin.list-courier',compact (['couriers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan halaman penambahan data Couriear
        return view ('admin.create-courier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menyimpan data courier
        if(Courier::where('courier',$request->courier)->exists()){
            return redirect('/courier')->with('gagal','Gagal menambahkan data, data courier sudah terdaftar');
        }
        $courier = new Courier;
        $courier->courier = $request->courier;
        $courier->save();
        return redirect('/courier')->with('berhasil','Anda Berhasil menambahkan data courier');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Menampilkan tampilan edit
        $courier=Courier::where('id',$id)->first(); 
        return view ('admin.edit-courier',compact(['courier']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Mmeperbarui data
        if(Courier::where('courier',$request->courier)->exists()){
            return redirect('/courier')->with('gagal','Gagal menngubah data, data courier sudah terdaftar');
        }
        Courier::where('id',$id)->update([
                    'courier'=>$request->courier,
                    'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
                ]);
        return redirect('/courier')->with('berhasil','Data Courier Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Menghapus data
        $courier=Courier::find($id);
        $courier->delete();
        return redirect('/courier')->with('berhasil','Data Courier Berhasil Dihapus');
    }
}
