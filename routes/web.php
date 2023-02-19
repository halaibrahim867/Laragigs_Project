<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello',function (){
    return response('<h1>hello world</h1>',200)
        ->header('Content-Type','text/plain')
        ->header('foo','bar');   //there are in inspect
});

Route::get('/post/{id}',function ($id){
    return response('Post '. $id);
})->where('id','[0-9]+');

Route::get('/search',function (\Illuminate\Http\Request $request){
    return 'your name is: '.$request->name.' '.',and your age is: '.$request->age ;
});

//all listing
Route::get('/',function (){
    return view('listings',[
        'heading'=>'Latest Listings',
        'listings'=> \App\Models\Listing::all(),

    ]);
});

//single listing

Route::get('/listing/{id}',function ($id){
    return view('listing',[
        'listing'=> \App\Models\Listing::find($id)
    ]);
});
