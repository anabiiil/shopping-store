<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'url', 'description','status','title','created_at','updated_at',
    ];


    public function getStatus(){
        return $this->status == "1" ? 'active' : ' Un active';
    }

}
