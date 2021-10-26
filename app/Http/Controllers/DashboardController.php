<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AudioContent;
use App\Models\VideoContent;
use App\Models\TextContent;
use App\Models\WallpaperContent;
use App\Models\NameOfAlllah;
use App\Models\Subscription;
use App\Models\SalatTime;
use Carbon\Carbon;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['audioContent'] = AudioContent::count();
        $data['videoContent'] = VideoContent::count();
        $data['wallpaperContent'] = WallpaperContent::count();
        $data['nameOfAllah'] = NameOfAlllah::count();
        $data['textContent'] = TextContent::count();
        $data['totalCategory'] = Category::where('status',1)->count();
        $data['latestAudio'] = AudioContent::orderBy('id','desc')->limit(5)->get();
        $data['latestWallpaper'] = WallpaperContent::orderBy('id','desc')->limit(5)->get();
        $data['latestCategory'] = Category::where('status',1)->orderBy('cat_name','asc')->limit(5)->get();
        $data['todaySalatTime'] = SalatTime::where('date',Carbon::today()->toDateString())->first();
        $data['weeklySalatTime'] = SalatTime::whereBetween('date',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->get();
        
        return view('backend.dashboard',$data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
