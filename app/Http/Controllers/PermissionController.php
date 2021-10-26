<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Validator;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissionList = Permission::orderBy('id','desc')->get();
        return view('backend.permissions.index',compact('permissionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                    'name' => 'required',
                    'group_name' => 'required',
                    
                    
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
       $permission = new Permission;
       $permission->name = $request->name;
       $permission->group_name = $request->group_name;
       try {
            $permission->save();
            toastr()->success('Permission add successfully');
            return redirect()->route('permissions.index'); 
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
        //
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
       $permission = Permission::findOrFail($id);
       $permission->name = $request->name;
       $permission->group_name = $request->group_name;
       try {
            $permission->save();
            toastr()->success('Permission Update successfully');
            return redirect()->route('permissions.index'); 
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
       $delete = Permission::findOrFail($id);
        
        if($delete->delete()){
            toastr()->info('Permission delete successfully');
            return redirect()->route('permissions.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
