<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Toastr;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryList = Category::orderBy('id','DESC')->get();
        
        return view('backend.categories.index',compact('categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
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
            'cat_name' => 'required',
            'cat_name_bn' => 'required',
            'cat_code' => 'required',
            'content_type' => 'required'
        ]);
        $category = new Category;
        $category->cat_name = $request->cat_name;
        $category->cat_name_bn = $request->cat_name_bn;
        $category->cat_code = $request->cat_code;
        $category->content_type = $request->content_type;
        $category->status = $request->status;

        if($request->hasFile('icon')){

            $main_photo=$request->file('icon');
            $main_fileType=$main_photo->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            $main_photo->move(public_path().'/uploads/category/icons',$main_fileName);
            $category->icon = $main_fileName;

        }else{
            $category->icon = '';
        }
        
        
        if($category->save()){
            toastr()->success('Category insert successfully');
            return redirect()->route('categories.index');
        }
        else{
            toastr()->error('Something went wrong');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        $category = Category::findOrFail($category->id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $category = Category::findOrFail($category->id);
        $category->cat_name = $request->cat_name;
        $category->cat_name_bn = $request->cat_name_bn;
        $category->cat_code = $request->cat_code;
        $category->content_type = $request->content_type;
        $category->status = $request->status;

        if($request->hasFile('icon')){

            $main_photo=$request->file('icon');
            $main_fileType=$main_photo->getClientOriginalExtension();
            $main_fileName=rand(1, 1000).date('dmyhis').".".$main_fileType;

            
            $main_photo->move(public_path().'/uploads/category/icons',$main_fileName);
            $category->icon = $main_fileName;

        }else{
            $category->icon = $category->icon;
        }

        if($category->save()){
            toastr()->success('Category update successfully');
            return redirect()->route('categories.index');
        }
        else{
            
            toastr()->error('Something went wrong');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        

        $deleteCategory = Category::findOrFail($id);

        if($deleteCategory->delete()){
            toastr()->info('Category delete successfully');
            return redirect()->route('categories.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }

    public function statusUpdate(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = $request->status;
        if($category->save()){
            return 1;
        }
        return 0;
    }

}
