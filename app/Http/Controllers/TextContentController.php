<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\TextContent;
use App\Models\ServiceName;
class TextContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $textContentList = TextContent::orderBy('id','DESC')->paginate(20);

        return view('backend.contents.texts.index',compact('textContentList'));
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
        return view('backend.contents.texts.create',compact('categoryList','serviceList'));
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
            'content_details' => 'required'
        ]);
        $text = new TextContent;
        $text->cat_id = $request->cat_id;
        $text->content_title = $request->content_title;
        $text->content_title_bn = $request->content_title_bn;
        $text->content_details = $request->content_details;
        $text->content_type = $request->content_type;
        $text->service_id = $request->service_id;

        try {
            $text->save();
            toastr()->success('Text content insert successfully');
            return redirect()->route('text-contents.index');
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
        $textFile = TextContent::findOrFail($id);
        $serviceList = ServiceName::get();
        return view('backend.contents.texts.edit',compact('categoryList','textFile','serviceList'));
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
        $text = TextContent::findOrFail($id);
        $text->cat_id = $request->cat_id;
        $text->content_title = $request->content_title;
        $text->content_title_bn = $request->content_title_bn;
        $text->content_details = $request->content_details;
        $text->content_type = $request->content_type;
        $text->service_id = $request->service_id;

        try {
            $text->save();
            toastr()->success('Text content update successfully');
            return redirect()->route('text-contents.index');
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
        $deleteText = TextContent::findOrFail($id);
        
        if($deleteText->delete()){
            toastr()->info('Text content delete successfully');
            return redirect()->route('text-contents.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
