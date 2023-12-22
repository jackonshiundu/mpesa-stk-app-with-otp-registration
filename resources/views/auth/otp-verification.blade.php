@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('OTP') }}</div>
                <div class="card-body">
                    @if (session('success'))
                        <div role='alert' class='alert alert-success'>
                            {{session('success')}}
                        </div>
                    @endif <!-- Add this line -->
                    @if (session('error'))
                        <div role='alert' class='alert alert-danger'>
                            {{session('error')}}
                        </div>
                    @endif <!-- Add this line -->

                        <form method="POST" action="{{route('otp.loginwithotp')}}">
                        @csrf
                        <input type='hidden' name='user_id' value="{{$user_id}}">
                        <div class="row mb-3">
                            <label for="otp" class="col-md-4 col-form-label text-md-end">{{ __('OTP') }}</label>
                            <div class="col-md-6">
                                <input id="otp" type="otp" class="form-control @error('otp') is-invalid @enderror" name="otp" placeholder='Enter OTP' value="{{ old('otp') }}" required autocomplete="otp" autofocus>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('Login with Username?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
