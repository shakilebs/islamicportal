<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommonPage;
class CommonPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageList = CommonPage::orderBy('id','DESC')->paginate(20);

        return view('backend.commonpages.index',compact('pageList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('backend.commonpages.create');
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
            
            'page_name' => 'required',
            'page_content' => 'required'
        ]);
        $page = new CommonPage;
        $page->page_name = $request->page_name;
        $page->page_name_bn = $request->page_name_bn;
        $page->slug = str_replace(' ', '-', strtolower($page->page_name));
        $page->page_content = $request->page_content;

        try {
            $page->save();
            toastr()->success('Page insert successfully');
            return redirect()->route('common-page.index');
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
        
        $page = CommonPage::findOrFail($id);
        return view('backend.commonpages.edit',compact('page'));
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
        $page = CommonPage::findOrFail($id);
        $page->page_name = $request->page_name;
        $page->page_name_bn = $request->page_name_bn;
        $page->slug = str_replace(' ', '-', strtolower($page->page_name));
        $page->page_content = $request->page_content;


        try {
            $page->save();
            toastr()->success('Page update successfully');
            return redirect()->route('common-page.index');
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
        $pagedelete = CommonPage::findOrFail($id);
        
        if($pagedelete->delete()){
            toastr()->info('Page delete successfully');
            return redirect()->route('common-page.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
}
