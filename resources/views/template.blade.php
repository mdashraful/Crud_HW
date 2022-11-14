<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ config('app.name') }}</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="{{ route('student.index') }}" class="logo">Practice</a>
            <div class="nav">
                <a href="{{ route('student.index') }}">All Student</a>
                <a href="{{ route('student.create') }}">Registration</a>
            </div>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"></script>

@yield('script')

</html>