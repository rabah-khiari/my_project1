@extends('base')
@section('title','index one')
@section('content')
 <livewire:seat-reservation :spectacleid="$spectacletId" />
 
@endsection

@section('test')
<h1>test content </h1>
@endsection