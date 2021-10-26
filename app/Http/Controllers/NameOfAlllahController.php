<?php

namespace App\Http\Controllers;

use App\Models\NameOfAlllah;
use Illuminate\Http\Request;
use Toastr;
use Auth;
use App\Models\User;
class NameOfAlllahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('web')->User();

            return $next($request);
        });
    }
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('allah-name.index')){
            
             toastr()->error('Permission Denied! Unauthorize Access');
             return back();
        }
        
        $nameList = NameOfAlllah::orderBy('id','DESC')->get();
        
        return view('backend.allah-name.index',compact('nameList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       return view('backend.allah-name.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name_bn' => 'required',
            'name_ar' => 'required',
            'meaning' => 'required'
        ]);
        $nameList = new NameOfAlllah;
        $nameList->name_bn = $request->name_bn;
        $nameList->name_ar = $request->name_ar;
        $nameList->meaning = $request->meaning;

        if($request->hasFile('file_name')){

            $main_audio=$request->file('file_name');
            $main_fileType=$main_audio->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_audio->move(public_path().'/uploads/contents/allahname',$main_fileName);
            $nameList->file_name = $main_fileName;

        }else{
            $nameList->file_name = '';
        }

        
        
        if($nameList->save()){
            toastr()->success('Name insert successfully');
            return redirect()->route('allah-name.index');
        }
        else{
            toastr()->error('Something went wrong');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NameOfAlllah  $nameOfAlllah
     * @return \Illuminate\Http\Response
     */
    public function show(NameOfAlllah $nameOfAlllah)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NameOfAlllah  $nameOfAlllah
     * @return \Illuminate\Http\Response
     */
    public function edit(NameOfAlllah $nameOfAlllah,$id)
    {
        if(is_null($this->user) || !$this->user->can('allah-name.edit')){
            
             toastr()->error('Permission Denied! Unauthorize Access');
             return back();
        }
        $nameList = NameOfAlllah::findOrFail($id);
        return view('backend.allah-name.edit', compact('nameList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NameOfAlllah  $nameOfAlllah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NameOfAlllah $nameOfAlllah,$id)
    {
        $nameList = NameOfAlllah::findOrFail($id);
        
        $nameList->name_bn = $request->name_bn;
        $nameList->name_ar = $request->name_ar;
        $nameList->meaning = $request->meaning;
        if($request->hasFile('file_name')){

            $main_audio=$request->file('file_name');
            $main_fileType=$main_audio->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_audio->move(public_path().'/uploads/contents/allahname',$main_fileName);
            $nameList->file_name = $main_fileName;

        }else{
            $nameList->file_name = $nameList->file_name;
        }
        if($nameList->save()){
            toastr()->success('Name list update successfully');
            return redirect()->route('allah-name.index');
        }
        else{
            
            toastr()->error('Something went wrong');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NameOfAlllah  $nameOfAlllah
     * @return \Illuminate\Http\Response
     */
    public function destroy(NameOfAlllah $nameOfAlllah,$id)
    {
        if(is_null($this->user) || !$this->user->can('allah-name.destroy')){
            
             toastr()->error('Permission Denied! Unauthorize Access');
             return back();
        }
        $deleteName = NameOfAlllah::findOrFail($id);
        if(!empty($deleteName)){
            unlink(public_path().'/uploads/contents/allahname/'.$deleteName->file_name);
        }
        if($deleteName->delete()){
            toastr()->info('Name List delete successfully');
            return redirect()->route('allah-name.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
