<?php

namespace App\Http\Controllers;

use App\Models\IslamicContent;
use App\Models\Category;
use Illuminate\Http\Request;

class IslamicContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();
        return view('backend.contents.create')
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
     * @param  \App\Models\IslamicContent  $islamicContent
     * @return \Illuminate\Http\Response
     */
    public function show(IslamicContent $islamicContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IslamicContent  $islamicContent
     * @return \Illuminate\Http\Response
     */
    public function edit(IslamicContent $islamicContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IslamicContent  $islamicContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IslamicContent $islamicContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IslamicContent  $islamicContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(IslamicContent $islamicContent)
    {
        //
    }
}
