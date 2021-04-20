<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = array('name','url','description','parent_id', 'status');




    //relations ----------------------------------
        public function products()
        {
            return $this->hasMany('App\Models\Product');
        }

        public function parent_category()
        {
            return $this->belongsTo(self::class,'parent_id');
        }

        public function child_categories()
        {
            return $this->hasMany(self::class, 'parent_id');
        }


     //scopes --------------------------------------
     public function scopeWhenSearch($query, $search)
     {
         return $query->when($search, function ($q) use ($search) {
             return $q->where('name', 'like', "%$search%");
         });

     }// end of scopeWhenSearch

     public function getActive(){
         return $this->status == "active" ? 'active' : '  un_active';
     }

}
