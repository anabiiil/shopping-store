<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'coupons';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = array('coupon_code','status','amount','amount_type','expiry_date');


         // GET ACITVE STATUS
         public function getActive(){
             return $this->status == "active" ? 'active' : 'Un active  ';
         }

         // GET amout tyoe
         public function getAmountType(){
            return $this->amount_type == "Percentage" ? 'Percentage' : 'Fixed ';
        }

}
