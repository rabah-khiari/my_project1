@extends('base')
@section('title','login')
@section('content')
    <h1>Login page </h1>

    <div class="container mt-3">
       
        <form action="{{route('auth.login')}}" method="post">
          @csrf
          <div class="mb-3 mt-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email">
          </div>
          @error('email')
          {{$message}}
          @enderror
          <div class="mb-3">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password"  name="password">
          </div>
          @error('password')
          {{$message}}
          @enderror
          <div class="form-check mb-3">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    
@endsection

@section('test')
<h1>test content </h1>
@endsection