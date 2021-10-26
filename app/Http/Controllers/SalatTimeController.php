<?php

namespace App\Http\Controllers;

use App\Models\SalatTime;
use App\Imports\SalatTimesImport;
use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use Auth;
class SalatTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salatTimeList = SalatTime::get();

        return view('backend.salattime.index',compact('salatTimeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.salattime.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            if($request->hasFile('salat_csv_upload')){
               $rows = Excel::toArray(new SalatTimesImport, request()->file('salat_csv_upload'));
               
               
               foreach($rows[0] as $key => $salat){
                $convertDate = ($salat['date'] - 25569) * 86400;
                $salat['date'] = gmdate('Y-m-d',$convertDate);
                $getDay = Carbon::createFromFormat('Y-m-d', $salat['date'])->format('l');
                $salat['day_name'] = $getDay;
                
                if($salat['day_name'] == 'Friday'){
                    $salat['day_name_bn'] = 'শুক্রবার';
                }
                if($salat['day_name'] == 'Saturday'){
                    $salat['day_name_bn'] = 'শনিবার';
                }
                if($salat['day_name'] == 'Sunday'){
                    $salat['day_name_bn'] = 'রবিবার';
                }
                if($salat['day_name'] == 'Monday'){
                    $salat['day_name_bn'] = 'সোমবার';
                }
                if($salat['day_name'] == 'Tuesday'){
                    $salat['day_name_bn'] = 'মঙ্গলবার';
                }
                if($salat['day_name'] == 'Wednesday'){
                    $salat['day_name_bn'] = 'বুধবার';
                }
                if($salat['day_name'] == 'Thursday'){
                    $salat['day_name_bn'] = 'বৃহস্পতিবার';
                }
                $salat['year'] = Carbon::createFromFormat('Y-m-d', $salat['date'])->format('Y');
                $salat['iftar'] = $salat['maghrib'];
                $salat['created_by'] = Auth::User()->id;
                
                $salatTime = new SalatTime();
                $salatTime->date = $salat['date'];
                $salatTime->year = $salat['year'];
                $salatTime->day_name = $salat['day_name'];
                $salatTime->day_name_bn = $salat['day_name_bn'];
                $salatTime->seheri = $salat['seheri'];
                $salatTime->iftar = $salat['iftar'];
                $salatTime->fajr = $salat['fajr'];
                $salatTime->dhuhr = $salat['dhuhr'];
                $salatTime->asr = $salat['asr'];
                $salatTime->maghrib = $salat['maghrib'];
                $salatTime->isha = $salat['isha'];
                $salatTime->sunset = $salat['sunset'];
                $salatTime->created_by = $salat['created_by'];

                $salatTime->save();
               }
               
               
            }
            toastr()->success('Salat time insert successfully');
            return redirect()->route('prayer-times.index');
        } catch (Exception $e) {
            $bug = $e->getMessage();
            toastr()->error($bug);
            return back();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalatTime  $salatTime
     * @return \Illuminate\Http\Response
     */
    public function show(SalatTime $salatTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalatTime  $salatTime
     * @return \Illuminate\Http\Response
     */
    public function edit(SalatTime $salatTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalatTime  $salatTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalatTime $salatTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalatTime  $salatTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalatTime $salatTime)
    {
        //
    }
}
