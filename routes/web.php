<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});
Route::get('/spatie-cache', function() {
    $exitCode = Artisan::call(' cache:forget spatie.permission.cache');
    return '<h1>Spatie Cache cleared</h1>';
});


Route::get('/', function(){
    if (Auth::check()){
        return redirect('/admin/dashboard');
    }else{
      return redirect('/login');  
    }
    
});






