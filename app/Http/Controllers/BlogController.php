<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Requests\BlogFilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;

class BlogController extends Controller
{
    public function index () {
        /*
        $Validator= Validator::make([
            'titre'=>'eaaee'
        ],[
            'titre'=>'required|min:5|max:12'
        ]);*/
        #dd($Validator->errors()); if any error it return the error
        #dd($Validator->validated()); if there is invalide input , u will redirect to the precedent page 
        /*
        get posts with category 
        $post = Post::find(2); #add new items 
        $cat=$post->category->name;*/
        
        /* get all post apartien a un category 
        $cat = Category::find(2);
        dd($cat->posts()->where('id','>','2')->get());
    
        associate category to posts
        $cat = Category::find(2);
        $post = Post::find(6);
        $post->category()->associate($cat);
        $post->save();

        associate post to category with many to many relation  (attach , sync , syncWithoutDetaching)
            attach to add new column , sync to delete every thing and remain only the tage 1,2 like  sync(1,2); ,syncWith.. is to add new one if not exist 
        $post = Post::find(6);
        $tag = Tag::find(2);
        $post->tags()->syncWithoutDetaching($tag->id);
        dd($tag->name);
        
        inner join manual 
         $tags = DB::table('tags')
             ->join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->where('post_tag.post_id', '=', $post->id)
            ->select('tags.id','tags.name') // Specify the table to select the correct id
            ->get();
            
        create user using the filable models /App/models/User  protected $Filable 
        User::create([
            'name'=>'rabah',
            'email'=>'rabah@gmail.com',
        'password'=>Hash::make('0000') ]);
        */
       //dd($idd);
        //$var= \App\Models\Post::with('tags','category')->paginate(3);
       return view('index');

    }

    public function create()  {
        return view('create',[

            'categories'=>Category::select('id','name')->get(),
            'tags'=>Tag::select('id','name')->get()]);

    }
    public function seats($id)  {
        return view('seats', ['spectacletId' => $id]);

    }
    public function edit(Post $post) {

        return view('edit',['post'=>$post,
         'categories'=>Category::select('id','name')->get(),
        'tags'=>Tag::select('id','name')->get()]);

    }

    public function update(Post $post, BlogFilterRequest $request) {
        $post->title=$request->input('title');
        $post->slug=$request->input('slug');
        $post->content=$request->input('content');
        $post->category_id=$request->input('category_id');
        $post->tags()->sync( $request->input('tags'));

        /** @var UploadedFile|null $image  */
        $image=$request->validated('image');
        
        
        if($image != null && !$image->getError()) #image est valid et n'est pas vide 
        {
            if($post->image) { # verify befor removing 
                Storage::disk('public')->delete($post->image);
                
            }

            $imagePath=$image->store('blog','public');# store the image on /public/blog/HashedID.jpg 
            $post->image=$imagePath;

        }
        
        $post->save();
       
        return redirect()->route('blog.show',['post'=>$post->slug])->with('success','updated with success');
    }
    public function store(BlogFilterRequest $request)  {
      
        /** @var UploadedFile|null $image  */
        $image=$request->validated('image');
        
        if($image != null && !$image->getError()) #image est valid et n'est pas vide 
        {
            $imagePath=$image->store('blog','public');# store the image on /public/blog/HashedID.jpg 
        }
        $post = new \App\Models\Post(); #add new items 
        $post->title=$request->input('title');
        $post->slug=$request->input('slug');
        $post->category_id=$request->input('category_id');
        $post->content=$request->input('content');
        $post->image=$imagePath;
        $post->save();
        $post->tags()->sync( $request->input('tags'));
        $post->save();
        
        #dd($request->all());
        return redirect()->route('blog.show',['post'=>$post->slug])->with('success','created with success');
        
    }

    public function show (Post $post): RedirectResponse | View {

       # return to_route('blog.show',['slug'=>$var->slug,'id'=>$var->id]);

       return view('show',[
        'post'=>$post
       ]); 
    }

    /*
    public function show (string $slug,string $id ): RedirectResponse | View {
        $var= Post::findOrFail($id);
       
        return to_route('blog.show',['slug'=>$var->slug,'id'=>$var->id]);

       return view('show',[
        'post'=>$var
       ]); 
    }
    */

}
