@extends('base')
@section('title','cree article')
@section('content')
    <h1>c'est index creat bnjreee</h1>

   

   <form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title"> title</label>
        <input type="text" name="title" value="{{old('title','le titre')}} ">
        @error('title')
            {{$message}}
        @enderror
    </div>

    <div class="form-group">
        <label for="content"> content</label>
        <input type="text" name="content" value="{{old('content','le contenue')}}  ">
    </div>

    <div class="form-group">
        <label for="slug"> slug</label>
        <input type="text" name="slug" value="{{old('slug',"le slug")}} ">
    </div>

    <div class="form-group" >
        <label for="image"> Image</label>
        <input type="file" class="form-control" id="image" name="image" >
    </div>
   
    <select class="form-select" id="category" name="category_id">  
        
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>

    <select class="form-select" id="tag" name="tags[]" multiple>  
        
        @foreach($tags as $tag)
            <option    value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

    </select>

    <button type="submit" >submite </button>
   </form>
@endsection

@section('test')
<h1>test content </h1>
@endsection