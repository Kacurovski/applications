@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/pages/forgot_password.css'
])

@section('content')
<div class="forgot-password-container vh-100">
    <div class="row">
        <div class="col-10 col-md-8 col-lg-6 m-auto">
            <div class="logo-container text-center">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>
            @if (session('status'))
            <p class="font-size-15 text-success" role="alert">
                {{ session('status') }}
            </p>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="forgot-password-form">
                @csrf
                <div class="mb-3">
                    <label for="email" class="mb-2 font-size-15">Email адреса</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="example@example.com">
                    @error('email')
                    <p class="font-size-12 text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn font-size-11">Испрати линк за ресетирање на лозинката</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection