<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @auth
        <form action="{{route('auth.logout')}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-primary">{{\Illuminate\Support\Facades\Auth::user()->name}}-logOut</button>
            <a href="{{ route('blog.index')}}">blog</a>
        </form>

    @endauth
    @guest
    <button type="submit" class="btn btn-black"><a href="{{route('auth.login')}}"> se connecter </a> </button>  
    @endguest


    @yield('content')
    @yield('test')


</body>
</html>