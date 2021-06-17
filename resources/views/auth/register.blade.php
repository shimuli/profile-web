@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <main id="main">
        <br>
        <br>

        <div class="center">


            <div class="section-title">
                <h2 class=" mt-20">Register</h2>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                 @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} w-50"
                            id="name" placeholder="Name" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} w-50"
                            id="phone" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">

                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} w-50" id="email" placeholder="Email" name="email"
                            value="{{ old('email') }}">
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
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid': '' }} w-50" id="password" placeholder="Password"
                            name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Re-enter Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control w-50" id="password_confirmation" placeholder="Re-enter Password"
                            name="password_confirmation">
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
