<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/laravel-code/bootstrap.min.css') }}">
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="h3">Laravel Code helper</div>
        @if(request()->session()->has('generated'))
            @if(request()->session()->get('generated') == 'success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Woo</strong> Code generated successfully
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops</strong> Something went wrong
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @php request()->session()->remove('generated') @endphp
        @endif

        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li class="active">New Table</li>
                </ul>
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="{{ asset('js/laravel-code/bootstrap.min.js') }}"></script>
</body>
</html>
