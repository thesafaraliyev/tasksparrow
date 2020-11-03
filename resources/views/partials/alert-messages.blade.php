@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(\Illuminate\Support\Facades\Session::has($key))
        <p class="alert alert-{{ $key }}">{{ \Illuminate\Support\Facades\Session::get($key) }}</p>
    @endif
@endforeach
