<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImage;
class Product extends Model
{
    //Nama Tabel yang digunakan di SQL
    protected $table ='products';
    public $timestamps = false;
    //Relasi Many to Many dengan tabel product category
    public function RelasiProductCategory()
    {
        return $this->belongsToMany(ProductCategory::class,'product_category_details','product_id','category_id');
    }
    //Relasi One to Many dengan tabel product Image
    public function RelasiProductImage (){
        return $this->hasMany(ProductImage::class);
    }
    
}
