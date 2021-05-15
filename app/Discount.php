<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //Nama Tabel Yang digunakan dalam SQL
    protected $table = 'discounts';

    // protected static function boot() {
    //     parent::boot();
    
    //     static::saving(function($model){
    //         $model->discount_price = $model->weight / ($model->height * $model->height);
    //     }); 
    // }

    //Relasi dengan tabel product
    
}
