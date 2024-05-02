@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/pages/login.css'
])

@section('content')
<div class="admin-login-container row p-3">
    <div class="col-md-8 mx-auto">
        <div class="logo-container text-center custom-mb2">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
        <form method="POST" action="{{ route('admin.login') }}" class="font-size-12 custom-mb">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="font-weight-500 mb-2">Email адреса</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3 ">
                <label for="password" class="font-weight-500 mb-2">Лозинка</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <a class="forgot-password text-decoration-underline color-fancy-olive" href="{{ route('password.request') }}">
                    Ја заборави лозинката?
                </a>
            </div>

            <button type="submit" class="btn bg-lighblack btn-login w-100 font-size-15 mt-4">Логирај се</button>
        </form>

        <p class="copyright-paragraph font-size-10 text-center m-0">Сите права задржани @ Игралиште Скопје</p>

    </div>
</div>

@vite([
'resources/css/app.css',
'resources/css/pages/admin.css',
])

@endsection