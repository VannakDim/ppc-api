@extends('web.layouts.app_login')
@section('style')
<style>
    .card{
        width: 400px;
        /* background: grey; */
    }
    .center-screen{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .mb-3{
        margin-bottom: 10px;
    }
    .card-header{
        font-size: 3rem;
        text-align: center;
    }
    hr{
        padding-bottom: 20px;
    }

    .cc--1{
        font-size: 15px;
        display: flex;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>
            <hr>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0" style="margin-top: 20px">
                        <div class="col-md-6 offset-md-4"></div>
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary pull-right">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <div class="row mb-0" style="margin-top: 20px">
                        <div class="col-md-12 cc--1">
                            Already have an account <a style="padding-left: 5px" href="/login"> Login</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
