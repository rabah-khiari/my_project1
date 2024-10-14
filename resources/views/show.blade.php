@extends('base')
@section('title',$post->title)
@section('content')
    <h1>c'est index blog bnjr</h1>
    <h2>{{$post->title}}</h2>
    <h2>{{$post->slug}}</h2>
    {{"bonjoooooooooor"}}
    @if (session('success'))
        {{session('success')}}
    @endif
    @if($post->image)
        <img src="/storage/{{$post->image}}" alt="">
    @endif
 
        
    
@endsection
