<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WallpaperContent;
use App\Models\Category;
use App\Models\ServiceName;
class WallpaperContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentList = WallpaperContent::orderBy('id','DESC')->paginate(20);

        return view('backend.contents.wallpaper.index',compact('contentList'));
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
        return view('backend.contents.wallpaper.create',compact('categoryList','serviceList'));
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
        $content = new WallpaperContent;
        $content->cat_id = $request->cat_id;
        $content->content_title = $request->content_title;

        $maxID = WallpaperContent::max('id');
        
        $content->content_id = 'RP'.str_pad($maxID + 1, 6, '0', STR_PAD_LEFT);
        
        $content->content_title_bn = $request->content_title_bn;
        $content->content_type = $request->content_type;
        $content->service_id = $request->service_id;

        if($request->hasFile('file_name')){

            $main_photo=$request->file('file_name');
            $main_fileType=$main_photo->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_photo->move(public_path().'/uploads/contents/wallpapers',$main_fileName);
            $content->file_name = $main_fileName;

        }else{
            $content->file_name = '';
        }
        
        try {
            $content->save();
            toastr()->success('Wallpaper content insert successfully');
            return redirect()->route('wallpaper-contents.index');
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
        $contentFile = WallpaperContent::findOrFail($id);
        $serviceList = ServiceName::get();
        return view('backend.contents.wallpaper.edit',compact('categoryList','contentFile','serviceList'));
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
        $content = WallpaperContent::findOrFail($id);
        $content->cat_id = $request->cat_id;
        $content->content_title = $request->content_title;
        $content->content_title_bn = $request->content_title_bn;
        $content->content_type = $request->content_type;
        $content->service_id = $request->service_id;

        if($request->hasFile('file_name')){

            $main_photo=$request->file('file_name');
            $main_fileType=$main_photo->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_photo->move(public_path().'/uploads/contents/wallpapers',$main_fileName);
            $content->file_name = $main_fileName;

        }else{
            $content->file_name = $content->file_name;
        }

        try {
            $content->save();
            toastr()->success('Wallpaper content update successfully');
            return redirect()->route('wallpaper-contents.index');
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
        $deleteWallpaper = WallpaperContent::findOrFail($id);
        if(!empty($deleteWallpaper)){
            unlink(public_path().'/uploads/contents/wallpapers/'.$deleteWallpaper->file_name);
        }
        if($deleteWallpaper->delete()){
            toastr()->info('Wallpaper content delete successfully');
            return redirect()->route('wallpaper-contents.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
