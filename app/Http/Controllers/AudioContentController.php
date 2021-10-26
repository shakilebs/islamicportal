<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AudioContent;
use App\Models\ServiceName;
class AudioContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audioContentList = AudioContent::orderBy('id','DESC')->get();

        return view('backend.contents.audio.index',compact('audioContentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = Category::where('status',1)->orderBy('id','asc')->get();
        $serviceList = ServiceName::get();
        return view('backend.contents.audio.create',compact('categoryList','serviceList'));
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
            'cat_id' => 'required',
            'content_title' => 'required',
            'content_title_bn' => 'required',
            'content_type' => 'required',
            'file_name' => 'required'
        ]);
        $audio = new AudioContent;
        $audio->cat_id = $request->cat_id;
        $audio->content_title = $request->content_title;

        $maxID = AudioContent::max('id');
        
        $audio->content_id = 'RC'.str_pad($maxID + 1, 6, '0', STR_PAD_LEFT);
        
        $audio->content_title_bn = $request->content_title_bn;
        $audio->content_type = $request->content_type;
        $audio->service_id = $request->service_id;

        if($request->hasFile('file_name')){

            $main_audio=$request->file('file_name');
            $main_fileType=$main_audio->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_audio->move(public_path().'/uploads/contents/audio',$main_fileName);
            $audio->file_name = $main_fileName;

        }else{
            $audio->file_name = '';
        }
        
        
        if($audio->save()){
            toastr()->success('Audio content insert successfully');
            return redirect()->route('audio-contents.index');
        }
        else{
            toastr()->error('Something went wrong');
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
        $categoryList = Category::where('status',1)->orderBy('id','asc')->get();
        $audioFile = AudioContent::findOrFail($id);
        $serviceList = ServiceName::get();
        return view('backend.contents.audio.edit',compact('categoryList','audioFile','serviceList'));
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
        $audio = AudioContent::findOrFail($id);
        $audio->cat_id = $request->cat_id;
        $audio->content_title = $request->content_title;
        $audio->content_title_bn = $request->content_title_bn;
        $audio->content_type = $request->content_type;
        $audio->service_id = $request->service_id;

        if($request->hasFile('file_name')){

            $main_audio=$request->file('file_name');
            $main_fileType=$main_audio->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_audio->move(public_path().'/uploads/contents/audio',$main_fileName);
            $audio->file_name = $main_fileName;

        }else{
            $audio->file_name = $audio->file_name;
        }

        if($audio->save()){
            toastr()->success('Audio content update successfully');
            return redirect()->route('audio-contents.index');
        }
        else{
            
            toastr()->error('Something went wrong');
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
        $deleteAudio = AudioContent::findOrFail($id);
        if(!empty($deleteAudio)){
            unlink(public_path().'/uploads/contents/audio/'.$deleteAudio->file_name);
        }
        if($deleteAudio->delete()){
            toastr()->info('Audio content delete successfully');
            return redirect()->route('audio-contents.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
