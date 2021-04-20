<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "product_vote";

    protected $fillable = ['ref_user','ref_product','value','comment','active','date'];
}
