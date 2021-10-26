<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\VideoContent;
use App\Models\ServiceName;
class VideoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoContentList = VideoContent::orderBy('id','DESC')->paginate(20);

        return view('backend.contents.video.index',compact('videoContentList'));
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
        return view('backend.contents.video.create',compact('categoryList','serviceList'));
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
        $video = new VideoContent;
        $video->cat_id = $request->cat_id;
        $video->content_title = $request->content_title;

        $maxID = VideoContent::max('id');
        
        $video->content_id = 'RV'.str_pad($maxID + 1, 6, '0', STR_PAD_LEFT);
        
        $video->content_title_bn = $request->content_title_bn;
        $video->content_type = $request->content_type;
        $video->service_id = $request->service_id;

        if($request->hasFile('file_name')){

            $main_video=$request->file('file_name');
            $main_fileType=$main_video->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_video->move(public_path().'/uploads/contents/video',$main_fileName);
            $video->file_name = $main_fileName;

        }else{
            $video->file_name = '';
        }
        
        try {
            $video->save();
            toastr()->success('Video content insert successfully');
            return redirect()->route('video-contents.index');
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
        $categoryList = Category::where('status',1)->orderBy('id','asc')->get();
        $videoFile = VideoContent::findOrFail($id);
        $serviceList = ServiceName::get();
        return view('backend.contents.video.edit',compact('categoryList','videoFile','serviceList'));
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
        $video = VideoContent::findOrFail($id);
        $video->cat_id = $request->cat_id;
        $video->content_title = $request->content_title;
        $video->content_title_bn = $request->content_title_bn;
        $video->content_type = $request->content_type;
        $video->service_id = $request->service_id;
        if($request->hasFile('file_name')){

            $main_video=$request->file('file_name');
            $main_fileType=$main_video->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_video->move(public_path().'/uploads/contents/video',$main_fileName);
            $video->file_name = $main_fileName;

        }else{
            $video->file_name = $video->file_name;
        }

        try {
            $video->save();
            toastr()->success('Video content update successfully');
            return redirect()->route('video-contents.index');
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
        $deletevideo = VideoContent::findOrFail($id);
        if(!empty($deletevideo)){
            unlink(public_path().'/uploads/contents/video/'.$deletevideo->file_name);
        }
        if($deletevideo->delete()){
            toastr()->info('Video content delete successfully');
            return redirect()->route('video-contents.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
