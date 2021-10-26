<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\ServiceName;
use Validator;
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionList = Subscription::get();
        return view('backend.subscription.index',compact('subscriptionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceList = ServiceName::get();
        return view('backend.subscription.create',compact('serviceList'));
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
                    'service_id' => 'required',
                    'pack_name' => 'required',
                    'sub_pack' => 'required',
                    'pack_duration' => 'required',
                    'sub_details' => 'required',
                    'reg_msg' => 'required'
                    
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
       $subscription = new Subscription;
       $subscription->service_id = $request->service_id;
       $subscription->sort_order = $request->sort_order;
       $subscription->sub_pack = $request->sub_pack;
       $subscription->sub_pack_name = $request->sub_pack_name;
       $subscription->pack_name = $request->pack_name;
       $subscription->pack_duration = $request->pack_duration;
       $subscription->sub_details = $request->sub_details;
       $subscription->reg_msg = $request->reg_msg;
       $subscription->sub_text = $request->sub_text;
       $subscription->status = $request->status;
       $subscription->special_offer = $request->special_offer;
       $subscription->is_free = $request->is_free;
       $subscription->is_sep = $request->is_sep;
       try {
            $subscription->save();
            toastr()->success('Subscription add successfully');
            return redirect()->route('subscriptions.index');
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
        $subscription = Subscription::findOrFail($id);
        $serviceList = ServiceName::get();
        return view('backend.subscription.edit',compact('subscription','serviceList'));
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
                    'service_id' => 'required',
                    'pack_name' => 'required',
                    'sub_pack' => 'required',
                    'pack_duration' => 'required',
                    'sub_details' => 'required',
                    'reg_msg' => 'required'
                    
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
       $subscription = Subscription::findOrFail($id);
       $subscription->service_id = $request->service_id;
       $subscription->sort_order = $request->sort_order;
       $subscription->sub_pack = $request->sub_pack;
       $subscription->sub_pack_name = $request->sub_pack_name;
       $subscription->pack_name = $request->pack_name;
       $subscription->pack_duration = $request->pack_duration;
       $subscription->sub_details = $request->sub_details;
       $subscription->reg_msg = $request->reg_msg;
       $subscription->sub_text = $request->sub_text;
       $subscription->status = $request->status;
       $subscription->special_offer = $request->special_offer;
       $subscription->is_free = $request->is_free;
       $subscription->is_sep = $request->is_sep;
       try {
            $subscription->save();
            toastr()->success('Subscription Update successfully');
            return redirect()->route('subscriptions.index');
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
        $deleteText = Subscription::findOrFail($id);
        
        if($deleteText->delete()){
            toastr()->info('Subscription delete successfully');
            return redirect()->route('subscriptions.index');
        }else{
            toastr()->error('Something went wrong');
            return back();
        }
    }
    public function statusUpdate(Request $request){
        $subscribe = Subscription::findOrFail($request->id);
        $subscribe->status = $request->status;
        if($subscribe->save()){
            return 1;
        }
        return 0;
    }
}
