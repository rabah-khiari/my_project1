<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'dologin']);
Route::delete('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

Route::prefix('/blog')->name('blog.')->controller(\App\Http\Controllers\BlogController::class)->group(function(){
    
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create')->middleware('Authenticate');
    Route::get('/{post}/edit','edit')->name('edit')->middleware('Authenticate');
    Route::post('/{post}/edit','update')->name('update')->middleware('Authenticate');
    Route::post('/create','store')->name('store')->middleware('Authenticate');
    Route::get('/{post:slug}','show')->where([
                
        'post' =>'[a-z-0-9\-]+'
         ])->name('show');

    });
    /*
    Route::get('/{slug}-{id}','show')->where([
                
            'id'=>'[0-9]+',
            'slug' =>'[a-z-0-9\-]+'
             ])->name('show');
    
    });*/

 
 ?>