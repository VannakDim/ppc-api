<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pochentong Presbyterian Church
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="{{asset('web/css/loginStyle.css')}}" rel="stylesheet" />
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="./style.css">

        <!-- Styles -->
        
    </head> 
    <body class="antialiased">
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <form class="login" method="POST" action="{{ route('login') }}" >
                        {{ csrf_field() }}
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror login__input" placeholder="Email" required autocomplete="email" autofocus>

                            @error('email')
                            </br><span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror login__input" placeholder="Password" required autocomplete="password">
                            @error('password')
                            </br><span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="button login__submit" type="submit">
                            <span class="button__text">Log In Now</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>				
                        <div class="screen__content">
                            <div class="login__field">
                                Don't have an account <a class="" href="/register">Register</a>
                            </div>
                        </div>		
                    </form>
                    @if(Session::has('message'))
					    <p class="alert alert-success">{{ Session::get('message') }}</p>
				    @endif
                    {{-- <div class="social-login">
                        <h3>log in via</h3>
                        <div class="social-icons">
                            <a href="#" class="social-login__icon fab fa-google"></a>
                            <a href="#" class="social-login__icon fab fa-facebook"></a>
                            <a href="#" class="social-login__icon fab fa-twitter"></a>
                        </div>
                    </div> --}}
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>		
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>		
            </div>
        </div>
    </body>
</html>
