<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "order";

    protected $fillable = ['orderno','ref_user','ref_address','ref_basket','ref_orderstatus','ref_paymentmethod','ref_cargo','totalprice'];

}
