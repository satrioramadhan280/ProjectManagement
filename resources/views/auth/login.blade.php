<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{asset('img/small-logo.png')}}">
        <link rel="stylesheet" href="{{asset('css/signin.css')}}">
</head>

<body>
    <main class="form-signin">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{asset("img/logo.png")}}" class="mx-auto d-block mb-3" width="240px" height="60px" alt="">
            <div class="form-group">
                <div class="form-floating">
                    <input id="username" type="text" class="mt-3 form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>
                

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
               
                <div class="form-floating">
                    <input id="password" type="password" class="mt-2 mb-2 form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group text-center d-block">
                <button type="submit" class="w-100 btn btn-lg btn-danger">
                    {{ __('Login') }}
                </button>

            </div>
            <div class="text-center">

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    
</body>

</html>