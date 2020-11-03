@extends('layouts.auth-master')

@section('title', 'Home')

@section('content')
    <div class="col-lg-7 col-md-5 col-sm-4 col-3 d-none d-sm-block" id="wall"></div>

    <!-- form -->
    <div class="col-lg-5 col-md-7 col-sm-8 col-xs-12 my-5 form-container">
        <form method="post" action="{{ route('signIn') }}">
            @csrf
            <div class="text-center mb-4">
                <img class="mb-4" src="{{ asset('assets/images/lock.png') }}" alt="" width="65" height="65">
                <h1 class="h3 mb-3 font-weight-normal">Log in to your account</h1>
            </div>

            @include('partials.alert-messages')
            <div class="form-label-group">
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email address"
                    required
                    autofocus
                    aria-describedby="email-validation">
                <label for="email">Email address</label>
                @error('email')
                <div id="email-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-label-group">
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                    aria-describedby="password-validation">
                <label for="password">Password</label>
                @error('password')
                <div id="password-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" name="remember"> Remember me
                </label>
            </div>
            <button class="btn btn-outline-dark btn-block" type="submit">Log in</button>

        </form>

        <div class="row pt-3">
            <div class="col-md-6">
                <a href="#" class="help-link">Forgot password?</a>
            </div>
            <div class="col text-md-right">
                <a href="{{ route('register') }}" class="help-link">Don't have an account? Register</a>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted text-center">&copy; TaskSparrow 2020</p>
    </div>
    <!-- form -->
@endsection
