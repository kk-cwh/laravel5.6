<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title','name','status','parent_id','description'];


    public function role(){
        return $this->belongsToMany(Role::class,'role_menus','menu_id','role_id');
    }
}
