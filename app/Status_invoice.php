<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_invoice extends Model
{
    protected $table = 'status_invoice';
    public $primaryKey = 'id';
    public $timestamps = false;
}
