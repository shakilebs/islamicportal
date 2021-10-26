<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleList = Role::all();

        return view('backend.roles.index', compact('roleList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionList = Permission::all();
        $permissionGroup = User::getPermissionGroups();
        return view('backend.roles.create',compact('permissionList','permissionGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:roles',
                    
                    
                ]);

       if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            toastr()->error($plainErrorText);
            
            return redirect()->back()->withErrors($validator)->withInput();
       }
       $roles = new Role;
       $roles->name = $request->name;
       try {
           $roles->save();

           $permissions = $request->permissions;
           if(!empty($permissions)){
            $roles->syncPermissions($permissions);
           }
            toastr()->success('Role add successfully');
            return redirect()->route('roles.index');

       } catch (Exception $e) {
          $bug = $e->getMessage();
            toastr()->error($bug);
            return back(); 
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissionGroup = User::getPermissionGroups();
        $permissions = Permission::all();
        return view('backend.roles.edit',compact('role','permissionGroup','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:roles,name,'.$id,
                    
                    
                ]);

       if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            toastr()->error($plainErrorText);
            
            return redirect()->back()->withErrors($validator)->withInput();
       }
       $roles = Role::findOrFail($id);
       $roles->name = $request->name;
       try {
           $roles->save();

           $permissions = $request->permissions;
           if(!empty($permissions)){
            $roles->syncPermissions($permissions);
           }
            toastr()->success('Role Update successfully');
            return redirect()->route('roles.index');

       } catch (Exception $e) {
          $bug = $e->getMessage();
            toastr()->error($bug);
            return back(); 
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRole = Role::findOrFail($id);

        try {
            $deleteRole->delete();
            toastr()->success('Role Delete successfully');
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            $bug = $e->getMessage();
            toastr()->error($bug);
            return back(); 
        }
    }
}
