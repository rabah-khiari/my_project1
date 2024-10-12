@extends('base')
@section('title','modifie article')
@section('content')
    <h1>c'est index creat bnjreee</h1>

   <form action="" method="post">
    @csrf
    <div>
        <input type="text" name="title" value="{{old('title',$post->title)}} ">
        @error('title')
            {{$message}}
        @enderror
    </div>
    
    <input type="text" name="content" value="{{old('content',$post->content)}}  ">
    <input type="text" name="slug" value="{{old('slug',$post->slug)}} ">
   
        
        <select class="form-select" id="category" name="category_id">  
            
            @foreach($categories as $category)
                <option @selected(old('select cat',$post->category_id)==$category->id) value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        @php
        //requiperer les tags id that post have in tags table like select tags.id from tags inner join post_tag on tags.id=post_tag.id where post_id=post->id 
            $tagsId=$post->tags()->pluck('tags.id'); 
        @endphp
           
        <select class="form-select" id="tag" name="tags[]" multiple>  
            
            @foreach($tags as $tag)
                <option  @selected($tagsId->contains($tag->id))  value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach

           
        </select>

    <button >submite </button>
   </form>
@endsection

@section('test')
<h1>test content </h1>
@endsection