
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1 offset-md-3">
                <h3>Reset Password</h3>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                <form role="form"  method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
                        <input type="text" class="form-control" placeholder="Your Email *" name="email" value="{{ old('email') }}" id="email"/>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Send" />
                        <a  class="btnSubmit"
                            href="{{ URL::previous() }}"
                            style=" padding-left: 62px;
                                    padding-right: 62px;
                                    padding-top: 7px;
                                    padding-bottom: 7px;">
                                    Go Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
