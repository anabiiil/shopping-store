<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;



    protected $table = 'banners';

    protected $fillable = [
        'image', 'title','status','link','created_at','updated_at',
    ];


    public function getStatus(){
        return $this->status == "1" ? 'active' : ' Un active';
    }

}
