<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alamat;

class AlamatController extends Controller
{
    public function index()
    {
    	$title = 'Set Alamat Toko';
    	$provinsi = $this->get_provinsi();
    	// dd($provinsi->rajaongkir->results);
    	return view('admin.alamat.index', compact('provinsi', 'title'));
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

    public function store(Request $request)
    {
    	$data = new Alamat;
    	$data->provinsi = $request->provinsi;
    	$data->kota = $request->kota;
    	$data->save();

    	return redirect()->back()->with('sukses', 'Alamat berhasil disimpan');
    }
}
