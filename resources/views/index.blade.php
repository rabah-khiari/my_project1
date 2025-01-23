@extends('base')
@section('title','index one')
@section('content')
{{-- live wire   --}}
 <livewire:seat-reservation :spectacleid="$spectacletId" /> 
    {{-- <h1>c'est index blog bnjr</h1>
    <a href="{{ route('blog.create')}}">create</a>
        {{"bonjoooooooooorzaaa"}}
    @foreach($posts as $post)
        <h4>{{$post->title}}</h4>
        <h4>{{$post->category?->name}}</h4>
        @if (!$post->tags->isEmpty())
            TaaGS
            @foreach ($post->tags as $tag)
                <div>{{$tag->name}}</div>
            @endforeach
            
        @endif
        <a href="{{ route('blog.update',['post'=>$post->id])}}">update</a>
        <a href="{{ route('blog.show',['post'=>$post->slug])}}">show</a>
        
    @endforeach
    
    {{$posts->links()}} --}}
@endsection

@section('test')
<h1>test content </h1>
@endsection