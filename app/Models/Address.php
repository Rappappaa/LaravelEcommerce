<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "address";

    protected $fillable = ['ref_user','receiver_name','receiver_surname','receiver_phone','address','ref_city','ref_district','quarter','default','active'];
}
