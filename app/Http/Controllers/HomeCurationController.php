<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\HomeCuration;
use App\Models\Category;
use App\Models\ServiceName;
use Response;
class HomeCurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curationsList = HomeCuration::orderBy('id','desc')->get();
        $categoryList = Category::all();
        $serviceList = ServiceName::all();
        return view('backend.curations.index',compact('curationsList','categoryList','serviceList'));
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
                    'name' => 'required|unique:home_curations',
                    'name_bn' => 'required',
                    'sort_order' => 'required',
                    'cat_id' => 'required',
                    'service_id' => 'required',
                    
                    
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
       $curation = new HomeCuration;
       $curation->name = $request->name;
       $curation->name_bn = $request->name_bn;
       $curation->sort_order = $request->sort_order;
       $curation->item_limit = $request->item_limit;
       $curation->status = $request->status;
       $curation->cat_id = $request->cat_id;
       $curation->service_id = $request->service_id;
       $catCode = Category::findOrFail($request->cat_id);

       $curation->cat_code = $catCode->cat_code;
       
       try {
            $curation->save();
            toastr()->success('Curation add successfully');
            return redirect()->route('curations.index'); 
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
       $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:home_curations,name,'.$id,
                    'name_bn' => 'required',
                    'sort_order' => 'required',
                    'cat_id' => 'required',
                    'service_id' => 'required',
                    
                    
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
       $curation = HomeCuration::findOrFail($id);
       $curation->name = $request->name;
       $curation->name_bn = $request->name_bn;
       $curation->sort_order = $request->sort_order;
       $curation->item_limit = $request->item_limit;
       $curation->status = $request->status;
       $curation->cat_id = $request->cat_id;
       $curation->service_id = $request->service_id;
       $catCode = Category::findOrFail($request->cat_id);

       $curation->cat_code = $catCode->cat_code;
       
       try {
            $curation->save();
            toastr()->success('Curation update successfully');
            return redirect()->route('curations.index'); 
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
       $delete = HomeCuration::findOrFail($id);
        
        if($delete->delete()){
            toastr()->info('Curation delete successfully');
            return redirect()->route('curations.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
    public function statusUpdate(Request $request){
        
        $statusUpdate = HomeCuration::findOrFail($request->id);
        if($request->el_name =='show_app'){
          $statusUpdate->show_app = $request->el_status;  
        }
        if($request->el_name =='show_web'){
            $statusUpdate->show_web = $request->el_status;
        }
        if($request->el_name =='status'){
            $statusUpdate->status = $request->el_status;
        }
        
        if($statusUpdate->save()){
            return 1;
        }
        return 0;
    }

    public function rowreorder(Request $request){
        $requestData = $request->all();

        if(!empty($request->ids)){
          foreach ($request->ids as $index => $id) {
            $findCurate = HomeCuration::findOrFail($id);
            $findCurate->sort_order = $index+1;
            $findCurate->save();
            $data['positions'][$findCurate->id] = $findCurate->sort_order;
            } 
          $data['success'] = 'Sorting row successfully updated';
          // $response['sort_order'] = $sort_order;   
        }else{
            $data['error'] = 'Something went wrong';
        }
        
        return response(['response'=>$data]);
       
    }
}
