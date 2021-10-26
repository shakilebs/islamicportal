<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use DB;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionGroups(){
        $getGroupName = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return $getGroupName;
    }
    public static function getPermissionByGroupName($group_name){
        $getPermissionByGroupname = DB::table('permissions')->where('group_name',$group_name)->get();

        return $getPermissionByGroupname;
    }

    public static function roleHasPermissions($role,$permissions){

        $hasPermission = true;
        
        foreach($permissions as $permit){

            if($role->hasPermissionTo($permit->name)){

                $hasPermission = false; 
                
                return $hasPermission;
            }
        }
       return $hasPermission; 
    }
}
