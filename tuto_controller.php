create controller on Terminal : php artisan make:controller BlogController


in the web.php page we create the controller system like : 

<?php

Route::prefix('/blog')->name('blog.')->controller(\App\Http\Controllers\BlogController::class)->group(function(){
              
    Route::get('/','index')->name('index');         #fct index in the controller 
                
    Route::get('/{slug}-{id}','show')->where([       #fct show in the controller 
                
            'id'=>'[0-9]+',
            'slug' =>'[a-z-0-9\-]+'
             ])->name('show');
    
 });



#in the BlogController : 
 
 public function index (): paginator {

    $var= \App\Models\Post::paginate(2);
   return $var; 

}

public function show (string $slug,string $id ): RedirectResponse | Post {

    $var= \App\Models\Post::findOrFail($id);
    if ($var->slug != $slug)
    {
        return to_route('blog.show',['slug'=>$var->slug,'id'=>$var->id]);

    }
   return $var; 
   
}

?>