@extends('layouts.auth')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
            <h3>Register new account</h3>
            <p>Access to the most powerfull tool in the entire design and web industry.</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf


                {{-- name --}}
                <input type="text" name="name"  placeholder="Name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                {{-- Email address --}}
                <input type="text" name="email"  placeholder="E-mail Address" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                {{-- password --}}
                <input type="password" name="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') }}">
                @error('password')
                <span class="invalid-feedback mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                {{-- password_confirmation --}}
                <input type="password" name="password_confirmation"  placeholder="Confirmation Password" class="form-control">


                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Register</button>
                </div>
            </form>
            <!-- form end  -->

            <div class="other-links">
                <div class="text">Or register with</div>
                <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a><a href="#"><i class="fab fa-google"></i>Google</a><a href="#"><i class="fab fa-linkedin-in"></i>Linkedin</a>
            </div>
            <div class="page-links">
                <a href="{{ route('login') }}">Login to account</a>
            </div>
        </div>
    </div>
</div>


@endsection
