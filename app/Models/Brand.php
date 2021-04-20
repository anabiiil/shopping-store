<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name', 'external_id','status','type','created_at','updated_at',
    ];

     //scopes --------------------------------------
     public function scopeWhenSearch($query, $search)
     {
         return $query->when($search, function ($q) use ($search) {
             return $q->where('name', 'like', "%$search%");
         });

     }// end of scopeWhenSearch

     public function getType(){

        return $this->type == "vendor" ? 'Vendor' : 'admin  ';
    }

    public function getStatus(){

        if($this->status == 'approved'){
            return "approved";
        }elseif($this->status == 'pending'){
            return "pending";
        }else{
            return "refused";
        }
    }

}
