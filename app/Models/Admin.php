<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name', 'email','photo','password','created_at','updated_at',
    ];

        public function products()
         {
         return $this->hasMany(Product::class,'external_id')->where('type','admin');
        }
    protected $hidden = [
        'password', 'remember_token',
    ];

     //attributes ---------------------------
     public function getNameAttribute($value)
     {
         return ucfirst($value);
     }// end of getNameAttribute

     //scopes ----------------

     public function scopeWhenSearch($query, $search)
     {
         return $query->when($search, function ($q) use ($search) {
             return $q->where('name', 'like', "%$search%");
         });

     }// end of scopeWhenSearch

     public function scopeWhenRole($query, $role_id)
     {
         return $query->when($role_id, function ($q) use ($role_id) {
             return $this->scopeWhereRole($q, $role_id);
         });

     }// end of scopeWhenRole

     public function scopeWhereRole($query, $role_name)
     {
         return $query->whereHas('roles', function ($q) use ($role_name) {
             return $q->whereIn('name', (array)$role_name)
                 ->orWhereIn('id', (array)$role_name);
         });

     }// end of scopeWhereRole

     public function scopeWhereRoleNot($query, $role_name)
     {
         return $query->whereHas('roles', function ($q) use ($role_name) {
             return $q->whereNotIn('name', (array)$role_name)
                 ->whereNotIn('id', (array)$role_name);
         });

     }// end of scopeWhereRoleNot

}
