@extends('layouts.page_login')
@section('login')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
        <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo text-body fw-bolder">Register</span>
        </a>
        </div>
        <!-- /Logo -->
        <br>
        <p class="mb-4">Creér  votre compte , s'il vous plait</p>
        @if(Session::has('error'))
        <p class="text-danger">{{Session::get('error')}}</p>
        @endif
        <form  method="POST" action="{{ route('admin.register.submit') }}">
            @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input
            type="text"
            class="form-control  {{ $errors->has('name') ? 'is-invalid': ''}}"

            name="name"
            placeholder="nom"


            />
            @if ($errors->has('name'))
                <span class="help-block">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="email" class="form-label  {{ $errors->has('email') ? 'text-danger': ''}}">Email</label>
            <input
            type="email"
            class="form-control  {{ $errors->has('email') ? 'is-invalid': ''}}"

            name="email"
            placeholder="xxxxx@email.com"


            />
            @if ($errors->has('email'))
                <span class="help-block">
                    <span class="text-danger">{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
            <label class="form-label  {{ $errors->has('password') ? 'text-danger': ''}}" for="password">Password</label>

            </div>
            <div class="input-group input-group-merge">
            <input
                type="password"

                class="form-control {{ $errors->has('password') ? 'is-invalid': ''}}"
                name="password"

            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </span>
            @endif
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Confirm password</label>

            </div>
            <div class="input-group input-group-merge">
            <input
                type="password"

                class="form-control  {{ $errors->has('password') ? 'is-invalid': ''}}"
                name="password_confirmation"

            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </span>
            @endif
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
        </div>
        </form>

        <p class="text-center">
        <span>Avez-vous deja un compte?</span>
        <a href="{{route('admin.login')}}">
            <span>se connecter</span>
        </a>
        </p>
    </div>
</div>
@endsection
