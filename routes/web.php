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
Route::get('/',[\App\Http\Controllers\ListingController::class, 'index']);

Route::get('/listings/create',
    [\App\Http\Controllers\ListingController::class,
        'create'])->middleware('auth');

Route::post('/listings',
    [\App\Http\Controllers\ListingController::class,
        'store'])->middleware('auth');

//single listing

Route::get('/listings/{listing}',
[\App\Http\Controllers\ListingController::class,
    'show']);

//show edit form
Route::get('/listings/{listing}/edit',[
    App\Http\Controllers\ListingController::class,
    'edit'])->middleware('auth');

Route::delete('/listings/{listing}',[
    App\Http\Controllers\ListingController::class,
    'destroy'])->middleware('auth');

Route::put('/listings/{listing}',[
    App\Http\Controllers\ListingController::class,
    'update'])->middleware('auth');

//show register / create form
Route::get('/register',[
    \App\Http\Controllers\UserController::class,'create'
])->middleware('guest');

//create new user
Route::post('/users',[
    \App\Http\Controllers\UserController::class,'store'
]);
//log out

Route::post('/logout',[
    \App\Http\Controllers\UserController::class,'logout'
])->middleware('auth');

//show login form
Route::get('/login',[
    \App\Http\Controllers\UserController::class,'login'
])->name('login')->middleware('guest');

//log in user
Route::post('/users/authenticate',[
    \App\Http\Controllers\UserController::class,'authenticate'
]);


//manage listings
Route::get('/listings/manage',[
    \App\Http\Controllers\ListingController::class,'manage'
])->middleware('auth');
