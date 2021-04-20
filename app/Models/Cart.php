<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = array('name','product_id','user_id','quantity', 'code' , 'color' ,'price');

    use HasFactory;
}
