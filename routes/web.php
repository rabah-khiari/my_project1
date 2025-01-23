<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'dologin']);
Route::delete('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');
Route::get('/spectacles', [\App\Http\Controllers\SpectacleController::class, 'index'])->name('spectacles.index');
Route::get('/spectacles/create', [\App\Http\Controllers\SpectacleController::class, 'create'])->name('spectacles.create');
Route::post('/spectacles/store', [\App\Http\Controllers\SpectacleController::class, 'store'])->name('spectacles.store');
Route::get('/spectacles/{spectacle}/edit', [\App\Http\Controllers\SpectacleController::class, 'edit'])->name('spectacles.edit');
Route::put('/spectacles/{spectacle}/update', [\App\Http\Controllers\SpectacleController::class, 'update'])->name('spectacles.update');
Route::delete('/spectacles/{spectacle}', [\App\Http\Controllers\SpectacleController::class, 'destroy'])->name('spectacles.destroy');



Route::prefix('/blog')->name('blog.')->controller(\App\Http\Controllers\BlogController::class)->group(function(){

    Route::get('/','index')->name('index');
    Route::get('/seats/{id}','seats')->name('seats');
    Route::get('/create','create')->name('create')->middleware('Authenticate');
    Route::get('/{post}/edit','edit')->name('edit')->middleware('Authenticate');
    Route::post('/{post}/edit','update')->name('update')->middleware('Authenticate');
    Route::post('/create','store')->name('store')->middleware('Authenticate');
    Route::get('/{post:slug}','show')->where([
                
        'post' =>'[a-z-0-9\-]+'
         ])->name('show');

    });
    

    // Route::get('/{slug}-{id}','show')->where([
                
    //         'id'=>'[0-9]+',
    //         'slug' =>'[a-z-0-9\-]+'
    //          ])->name('show');
    
    // });

 
 ?>