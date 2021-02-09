@extends('admin.admin-master')

@section('admin_content')

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin <span class="tx-info tx-normal">Login</span>
            </div>
            <hr>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Enter your email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-block">Login</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->

@endsection
