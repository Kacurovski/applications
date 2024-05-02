@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/pages/register.css',
])


@section('content')

<div class="login-container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="logo-container text-center">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <form method="POST" action="{{ route('register.store.step1') }}" class="font-size-12 font-weight-500 mb-3">
                @csrf
                <div class="mb-3">
                    <label for="email" class="mb-2">Email адреса</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" autofocus placeholder="example@example.com" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="mb-2">Лозинка</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="**********">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark w-100 fw-bold font-size-15 p-2" type="submit">Регистрирај се</button>
            </form>

            <div class="">
                <p class="text-center font-size-12">или</p>

                <div class="social-icons text-center mb-3">
                    <a href="{{ route('auth.google') }}" class="custom-ribon-pink-border btn btn-social btn-google font-size-12 font-weight-500">
                        <img src="{{ asset('images/google-icon.svg') }}" alt="Google"> Најави се преку Google
                    </a>

                    <a href="{{ route('auth.facebook') }}" class="custom-ribon-pink-border btn btn-social btn-facebook font-size-12 font-weight-500">
                        <img src="{{ asset('images/facebook-icon.svg') }}" alt="Facebook"> Најави се преку Facebook
                    </a>
                </div>

                <p class="text-center font-size-12 mb-5">Веќе имаш профил? <a href="{{ route('login.user') }}" class="text-decoration-underline color-fancy-olive">Логирај се!</a></p>
                <p class="copyright-paragraph font-size-10 text-center m-0">Сите права задржани @ Игралиште Скопје</p>
            </div>
        </div>
    </div>
</div>

@endsection