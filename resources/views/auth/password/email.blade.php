@extends('layouts.authpages')

@section('content')
<div class="animated fadeInDown">
    <div class="row">

        <div class="col-lg-12">
            <div class="ibox-content">

                <h2 class="font-bold">Forgot password</h2>

                <p>
                    Enter your email address and your password will be reset and emailed to you.
                </p>

                <div class="row">

                    <div class="col-lg-12">

                        @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif

                        <form class="m-t" role="form" method="POST" action="{{ route('send_reset_link') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary block full-width m-b"> Send Password Reset Link</button>

                            <a href="{{ route('login') }}">Back to Login</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection