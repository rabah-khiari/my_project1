in the variable .env 
    we shoold see the BDD configuration 

Migration 
    in the Terminal : php artisan make:migration CreatePostTable
    now we can go to /database > migration and see our migration file 
        we can add like 
        <?php

            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->timestamps();
        ?>
    after editing the file for new tables... we megrate by : php artisan migrate 
        now our table will be created on the database 
    we can generate a model of the table we create : php artisan make:model Post  
        now our model Post is created under : app > Models > Post.php
On the route web.php we can post and show the post content , the save will write on the BDD 
<?php

Route::get('/',function(Request $request){
    
    $post = new \App\Models\Post(); #add new items 
    $post->title='mon second article';
    $post->slug='mon-ee-article';
    $post->content='mon contenu 2';
    $post->save();
    return $post;

    return \App\Models\Post::all();# show all items on the post table  
    return \App\Models\Post::all(['id','title']);# show id and title on all items on the post table 
    $var = \App\Models\Post::all(['id','title']);
       return $var[0]->title;
    return \App\Models\Post::find(2); # find the element with id=1 
    return \App\Models\Post::findOrFail(4); # if there is no item , return 404 page 
    return \App\Models\Post::paginate(1, ['id','title']); # show the page one of the items 
    return \App\Models\Post::where('id','>','1')->get(); #get element where id>1
    return \App\Models\Post::where('id','>','1')->limit(10)->get();#limit with 1 elemnt 
    $var= \App\Models\Post::find(1);#find item to update
        $var->title="new title"; #affect the new update 
        $var->save(); #the server will detect the changes and will update the new item 
        return $var; 
    

})->name('index');

?>