<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User', 'users_id', 'id');
    }

    public function status()
    {
    	return $this->belongsTo('App\Status_invoice', 'status_invoice_id', 'id');
    }
    
}
