<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;



Auth::routes();	
Route::group(['prefix' =>'admin', 'middleware' => ['auth','roleHasPermission']], function(){
	Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
// Category route
	Route::resource('categories', CategoryController::class);
	Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
	Route::post('/categories/statusUpdate', 'CategoryController@statusUpdate')->name('categories.statusUpdate');

// Content Management Route---


	Route::resource('audio-contents', AudioContentController::class);
	Route::get('/audio-contents/destroy/{id}', 'AudioContentController@destroy')->name('audio-contents.destroy');
	Route::resource('video-contents', VideoContentController::class);
	Route::get('/video-contents/destroy/{id}', 'VideoContentController@destroy')->name('video-contents.destroy');
	Route::resource('wallpaper-contents', WallpaperContentController::class);
	Route::get('/wallpaper-contents/destroy/{id}', 'WallpaperContentController@destroy')->name('wallpaper-contents.destroy');
	Route::resource('text-contents', TextContentController::class);
	Route::get('/text-contents/destroy/{id}', 'TextContentController@destroy')->name('text-contents.destroy');
	
	// Route::post('/content-manage/statusUpdate', 'NameOfAlllahController@statusUpdate')->name('allah-name.statusUpdate');
// Name of allah routes
	Route::resource('allah-name', NameOfAlllahController::class);
	Route::get('/allah-name/destroy/{id}', 'NameOfAlllahController@destroy')->name('allah-name.destroy');

// Subscription List -----------------
	Route::resource('subscriptions', SubscriptionController::class);

	Route::post('/subscriptions/statusUpdate', 'SubscriptionController@statusUpdate')->name('subscriptions.statusUpdate');
	Route::get('/subscriptions/destroy/{id}', 'SubscriptionController@destroy')->name('subscriptions.destroy');
// Common Page routes-------------
	Route::resource('common-page', CommonPageController::class);
	Route::get('/common-page/destroy/{id}', 'CommonPageController@destroy')->name('common-page.destroy');
// Prayer times routes-------------
	Route::resource('prayer-times', SalatTimeController::class);
	Route::get('/prayer-times/destroy/{id}', 'SalatTimeController@destroy')->name('prayer-times.destroy');

	// Route::post('/allah-name/statusUpdate', 'NameOfAlllahController@statusUpdate')->name('allah-name.statusUpdate');

// Permission Management Routes---------------------
	Route::resource('permissions', PermissionController::class);
	Route::get('/permissions/destroy/{id}', 'PermissionController@destroy')->name('permissions.destroy');
	Route::resource('roles', RolesController::class);
	Route::get('/roles/destroy/{id}', 'RolesController@destroy')->name('roles.destroy');

	Route::resource('users', UserController::class);
	Route::get('/users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
	// Curations Route-----------------------------
	Route::resource('curations', HomeCurationController::class);
	Route::get('/curations/destroy/{id}', 'HomeCurationController@destroy')->name('curations.destroy');
	Route::post('/curations/statusUpdate', 'HomeCurationController@statusUpdate')->name('curations.statusUpdate');
});
	Route::post('/curations/rowreorder', 'HomeCurationController@rowreorder')->name('curations.rowreorder');
?>