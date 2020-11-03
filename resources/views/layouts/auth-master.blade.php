@include('layouts.head')

<link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

<div class="container-fluid">
    <div class="row" id="root">
        @yield('content')
    </div>
</div>

</body>
</html>
