<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan_product extends Model
{
    protected $table = 'pesanan_product';
    public $timestamps = false;

    public function pesanan()
    {
    	return $this->belongsTo('App\Pesanan', 'pesanan_id', 'id');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
