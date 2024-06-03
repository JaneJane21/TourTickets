<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('public\css\bootstrap.css') }}">
    <link rel="icon" href="{{ asset('public\logo\logo.jpg') }}" type="image/x-icon">
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.5/vue.global.js"></script>
<script src="{{ asset('public\js\bootstrap.bundle.js') }}"></script>
@include('layout.navbar')
@yield('content')
@include('layout.footer')
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
    p,a,h1,h2,h3,h4,h5,h6,div,button,li,td,input, label{
        font-family: 'Montserrat', sans-serif;
    }
</style>
</body>
</html>

