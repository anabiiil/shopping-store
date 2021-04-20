<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'product_id', 'price','stock','sku','size', 'created_at','updated_at'
    ];

    // protected $appends = ['date'];

	// public function getDateAttribute($value)
	// {
	// 	Carbon::setLocale('ar');
	// 	if (is_null($this->created_at)) {
	// 		return $value;
	// 	}
	// 	$value = $this->created_at->diffForHumans();
	// 	return $value;
	// }
}
