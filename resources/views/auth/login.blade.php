@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <main id="main">
        <br>
        <br>

        <div class="center">


            <div class="section-title">
                <h2 class=" mt-20">Register</h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf



                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} w-50"
                            id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password"
                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} w-50" id="password"
                            placeholder="Password" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="from-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                            value="{{ old('remember') ? 'checked' : '' }}">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </form>
        </div>

    </main>
    @include('footer.footer')
@endsection
