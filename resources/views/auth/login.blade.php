@extends('layouts.authpages')

@section('content')

<p>Administator Login</p>
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
@if (session('message'))
<div class="alert alert-info">
{{ session('message') }}
</div>
@endif

<div class="animated fadeInDown">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox-content">

                <form class="m-t" method="POST" role="form" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email" autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check text-left">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="{{ route('forget_password') }}">Forgot password?</a>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection