<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $table = 'konfirmasi';
    public $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo('App\User', 'users_id', 'id');
    }

    public function pesanan()
    {
    	return $this->belongsTo('App\Pesanan', 'pesanan_id', 'id');
    }
    
}
