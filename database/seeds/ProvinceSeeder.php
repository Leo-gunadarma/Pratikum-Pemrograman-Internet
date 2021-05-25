<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http ::withHeaders([
            'key'=>'0e458fb2459a58df8b4bd3ae0cf7b3c0'
        ])->get('https://api.rajaongkir.com/starter/province');
        $provincies = $response['rajaongkir']['results'];
        foreach ($provincies as $provincie){
            $data_province[]=[
                'id' => $provincie['province_id'],
                'provincie' => $provincie ['province']
            ];
        }
        Province::insert($data_province);
    }
}
