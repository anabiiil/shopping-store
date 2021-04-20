<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use SoftDeletes;

    use HasFactory;
    public function orders(){
    	return $this->hasMany('App\Models\OrderProduct','order_id');
    }

    // public static function getOrderDetails($order_id){
    // 	$getOrderDetails = Order::where('id',$order_id)->first();
    // 	return $getOrderDetails;
    // }

    // public static function getCountryCode($country){
    // $getCountryCode = Country::where('countryname ',$country)->first();
    // 	return $getCountryCode;
    // }
}
