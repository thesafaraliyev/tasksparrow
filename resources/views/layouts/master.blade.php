@include('layouts.head')

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">TaskSparrow</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ request()->routeIs('home') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('attachedTasks') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('attachedTasks') }}">Attached tasks</a>
            </li>
            <li class="nav-item {{ request()->routeIs('taskAdd') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('taskAdd') }}">Create task</a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">{{ Auth::user()->name }}</a>
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();this.closest('form').submit();">
                        Logout</a>
                </li>
            </form>
        </ul>

    </div>
</nav>
<!-- NAVBAR -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<div class="container p-3">
    @yield('content')
</div>

</body>
</html>
