@extends('layouts.auth')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}








<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Password Reset</h3>
            <p>To reset your password, enter the email address you use to sign in to iofrm</p>



            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif



            <form method="POST" action="{{ route('password.email') }}">


                
{{--

    attention plz



    @csrf missing




    --}}


                {{-- name --}}
                <input type="text" name="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <div class="form-button full-width">
                    <button id="submit" type="submit" class="ibtn btn-forget">Send Reset Link</button>
                </div>
            </form>
        </div>
        <div class="form-sent">
            <div class="tick-holder">
                <div class="tick-icon"></div>
            </div>
            <h3>Password link sent</h3>
            <p>Please check your inbox <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5f3630392d321f3630392d322b3a322f333e2b3a713630">[email&#160;protected]</a></p>
            <div class="info-holder">
                <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
            </div>

        </div>
    </div>
</div>
@endsection
