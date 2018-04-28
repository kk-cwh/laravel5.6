<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

   public function menus(){
       return $this->belongsToMany(Menu::class,'role_menus','role_id','menu_id');
   }

   public function permissions(){
       return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
   }

    public function users(){
        return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }

}
