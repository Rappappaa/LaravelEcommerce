<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempBasketItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "temp_basket_item";

    protected $fillable = ['ref_basket', 'ref_user', 'ref_product', 'quantity', 'itemtax', 'itemprice'];
}
