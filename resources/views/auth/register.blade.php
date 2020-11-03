@extends('layouts.auth-master')

@section('title', 'Home')

@section('content')
    <div class="col-lg-7 col-md-5 col-sm-4 col-3 d-none d-sm-block" id="wall"></div>

    <!-- form -->
    <div class="col-lg-5 col-md-7 col-sm-8 col-xs-12 my-5 form-container">
        <form method="post" action="{{ route('signUp') }}">
            @csrf
            <div class="text-center mb-4">
                <img class="mb-4" src="{{ asset('assets/images/lock.png') }}" alt="" width="65" height="65">
                <h1 class="h3 mb-3 font-weight-normal">Create new account</h1>
            </div>

            <div class="form-label-group">
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="email address"
                    required
                    aria-describedby="name-validation"
                    autofocus>
                <label for="name">Name</label>
                @error('name')
                <div id="name-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

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

            <button class="btn btn-outline-dark btn-block" type="submit">Register</button>

        </form>

        <div class="row pt-3">
            <div class="col text-md-right">
                <a href="{{ route('login') }}" class="help-link">Already registered? Login</a>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted text-center">&copy; TaskSparrow 2020</p>
    </div>
    <!-- form -->
@endsection
