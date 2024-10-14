
to make vsCode good with php and laravel 
    Ctrl + shift +x
    install :  PHP Intelephense , Laravel Blade Snippets , Laravel Extra Intellisense

    if u get the project from github u shold : cp .env.example .env
    first run : composer global require laravel/installer or  composer install or composer update 
   
    generate the new key : php artisan key:generate  and php artisan config:clear 
    GD extension in XAMPP : go to C:\xampp\php\php.ini and remove the ';' from  ;extension=gd

start the server : php artisan serve 

Authentication middle ware  : https://www.youtube.com/watch?v=Gr1Mmb1KYA8
link the storage to public/storage  : php artisan storage:link 

<?php 
#tuto ROUTE 

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('test');
});

Route::get('/blog',function(Request $request){
    
    return [
        "link" => \route('blog.show',['slug'=>'rabah','id'=>13]),
    ];
 })->name('blog.index');
 
 
 Route::get('/blog/{slug}-{id}',function(string $slug, string $id ){
     return [
         'slug'=>$slug,
         'id'=>$id
     ];

 })->where([
     'id'=>'[0-9]+',
     'slug' =>'[a-z-0-9\-]+'
 ])->name('blog.show');
 
#regroupement de routes 

#simplifie la route principale /blog et le nome des routes blog.


Route::prefix('/blog')->name('blog.')->group(function(){

    Route::get('/',function(Request $request){
    
        return [
            "link" => \route('blog.show',['slug'=>'rabah','id'=>13]),
        ];
    })->name('index');
     
    Route::get('/{slug}-{id}',function(string $slug, string $id ){
         return [
             'slug'=>$slug,
             'id'=>$id
         ];
    
    })->where([
                'id'=>'[0-9]+',
                 'slug' =>'[a-z-0-9\-]+'
             ])->name('show');
    
 });


 ?>