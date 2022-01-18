<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{asset('img/small-logo.png')}}">
    <link rel="stylesheet" href="{{asset('css/signin.css')}}">
</head>

<body>
    <main class="form-signin">
        <form method="POST" action="{{ route('resetPassword') }}">
            @csrf
            @method('patch')
            <h1 class="text-center">PT. XYZ</h1>
            <div class="form-group">
                <div class="form-floating">
                    <input id="username" type="text" class="mt-3 form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" autocomplete="username" autofocus
                        placeholder="Username">
                    <label for="floatingInput">Username</label>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-floating">
                    <input id="dateOfBirth" type="date"
                        class="mt-2 mb-2 form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth">
                    <label for="floatingPassword">Date of Birth</label>
                    @error('dateOfBirth')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    @if (session('fail'))
                    <div class="alert alert-danger mt-3">
                        {{ session('fail') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-group text-center d-block">
                <button type="submit" class="w-100 btn btn-lg btn-danger">
                    {{ __('Reset Password') }}
                </button>

            </div>
            <div class="text-center">
                <a class="btn btn-link" href="{{ route('login') }}">
                    {{ __('Back to login page') }}
                </a>
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