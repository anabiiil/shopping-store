<?php

namespace App\Models;

use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'external_id','status','type','cover','care','feature_item','price','color','code','description','discount','category_id','created_at','updated_at',
    ];

    protected $appends = ['cover_path'];

    public function getCoverPathAttribute()
    {
        return asset('uploads/products/cover/' . $this->cover);

    }//end of get image path


    public function fav()
    {
        return $this->hasOne(Favorite::class,'product_id','id');
    }
   public function user(){
       return $this->belongsTo('App\Models\User','id','external_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin','id','external_id');
     }


    // relations
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function images(){
        return $this->hasMany(Images::class);
    }
    public function transactions(){
    	return $this->hasMany('App\Models\Transaction','product_id');
    }

        //scopes --------------------------------------
        public function scopeWhenSearch($query, $search)
        {
            return $query->when($search, function ($q) use ($search) {
                return $q->where('name', 'like', "%$search%");
            });

        }// end of scopeWhenSearch


        public function getType(){

           return $this->type == "user" ? 'user' : 'Admin  ';
       }

       public function getActive(){
        return $this->status == "active" ? 'active' : 'Un active  ';
    }



    public static function productCount($cat_id){
    	$catCount = Product::where(['category_id'=>$cat_id,'status'=>'active'])->count();
    	return $catCount;
    }

    public static function getProductPrice($product_id,$product_size){
        $getProductPrice = Transaction::select('price')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
        return $getProductPrice->price;
    }


}
