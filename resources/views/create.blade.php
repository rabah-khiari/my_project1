@extends('base')
@section('title','cree article')
@section('content')
    <h1>c'est index creat bnjreee</h1>

   <form action="" method="post">
    @csrf
    <div>
        <input type="text" name="title" value="{{old('title','le titre')}} ">
        @error('title')
            {{$message}}
        @enderror
    </div>
    
    <input type="text" name="content" value="{{old('content','le content')}}  ">
    <input type="text" name="slug" value="{{old('slug','le slug')}} ">
    <button >submite </button>
   </form>
@endsection

@section('test')
<h1>test content </h1>
@endsection