<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Toastr;
use DB;
use Route;
use Artisan;
class RoleWiseAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle(Request $request, Closure $next)
    {

        

        // Implementation code--------------------
        $getRouteName = Route::currentRouteName();
        $user = Auth::guard('web')->User();
        // return $next($request) ;
        //------------------------ Check user Guard is valid or invalid----------- 
        if(!empty($user)){
            $userRole = DB::table('model_has_roles')->where('model_id',Auth::User()->id)->first();
            $getUserRole = Role::findOrFail($userRole->role_id);
            $allPermission = Permission::all();

            if($getRouteName == 'dashboard.index'){
                return $next($request) ;
            }
            
            if($getUserRole->id == 1){
              return $next($request);  
            }

            else{
                
                foreach($allPermission as $permission){

                   if($getUserRole->hasPermissionTo($permission->name)){
                    
                    $getRouteConversion = explode(".", $permission->name, 2);
                    
                    if($getRouteConversion[1] == 'index'){
                        
                        $permitArr[] = $getRouteConversion[0].'.show';
                        $permitArr[] = $getRouteConversion[0].'.statusUpdate';
                    }

                    if($getRouteConversion[1] == 'create'){
                        
                        $permitArr[] = $getRouteConversion[0].'.store';
                    }
                    
                    if($getRouteConversion[1] == 'edit'){
                        $permitArr[] = $getRouteConversion[0].'.update';
                    }
                    
                    //print_r($findDotAfterData);
                   
                     $permitArr[] = $permission->name;
                    
                   } 
                }
    // -----------------Get permit to next step----------------
                if(in_array($getRouteName, $permitArr)){
                    
                    return $next($request);
                }else{
                    toastr()->error('Permission Denied! Unauthorize Access');
                    return back();
                }


            }
            
            
        }else{
            abort('403','Unauthorize Access');
        }

    }
}
