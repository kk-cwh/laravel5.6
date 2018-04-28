<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($username){
        return User::where('name',$username)->first();
    }

    /**
     * 用户角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany\
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }
}
