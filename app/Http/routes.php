<?php

Route::get('/', function() {
    if(\App::getLocale() == 'no') {
        $data['categories'] = \App\Category::norsk()->active()->orderBy('order')->get();
    } else {
        $data['categories'] = \App\Category::icelandic()->active()->orderBy('order')->get();
    }
	return view('frontend.layout')->with($data);
});

Route::group(['prefix' => 'vorur'], function () {
    Route::get('/', 'VorukerfiController@index');
    Route::get('{slug}', 'VorukerfiController@show')->where(['slug' => '.*']);
});
Route::group(['prefix' => 'produkter'], function () {
    Route::get('/', 'VorukerfiController@index');
    Route::get('{slug}', 'VorukerfiController@show')->where(['slug' => '.*']);
});

Route::post('hafa-samband', 'ContactController@postContact');

Route::group(['middleware'=>'auth', 'prefix' => 'admin'], function () {
	Route::get('/', function() {
		return view('admin.layout');
	});

    // Reorder formable items
    Route::post('formable/_reorder', 'FormableController@reorder');

    // Reorder images
    Route::post('formable/_reorderImages', 'FormableController@reorderImages');
    
    // Reorder files
    Route::post('formable/_reorderFiles', 'FormableController@reorderFiles');
    
    // Get uploaded image
    Route::post('formable/_uploadImage', 'FormableController@uploadImage');

    // Delete image
    Route::post('formable/_deleteImage', 'FormableController@deleteImage');
    
    // Get uploaded file
    Route::post('formable/_uploadFile', 'FormableController@uploadFile');
    
    // Get images from this item
    Route::post('formable/_images', 'FormableController@images');
    
    // Get files from this item
    Route::post('formable/_files', 'FormableController@files');
    
    // Toggle formable status
    Route::post('formable/_toggle', 'FormableController@toggle');

    // Formable stjórnhlutir....
    foreach(config('formable.hlutir') as $hlutur) {
        Route::resource(strtolower($hlutur), ucfirst($hlutur).'Controller');
        Route::get(strtolower($hlutur).'/subs/{id}', ucfirst($hlutur).'Controller@subsIndex');
        Route::get(strtolower($hlutur).'/prods/{id}', ucfirst($hlutur).'Controller@prodsIndex');
    }

    Route::resource('orders', 'OrdersController');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Grípur allt sem ekki hefur verið fundið hér fyrir ofan
Route::get('{slug?}', ['as' => 'page', 'uses' => 'PageController@show'])->where(['slug' => '.*']);