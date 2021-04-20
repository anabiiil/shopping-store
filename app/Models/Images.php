<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

     protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products/product_images/' . $this->name);

    }//end of get image path


    public function product(){
        return $this->belongsTo(Product::class );
    }
}
