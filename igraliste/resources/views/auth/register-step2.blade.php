@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/pages/register.css',
])

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="logo-container text-center">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <form method="POST" action="{{ route('register.store.step2') }}" class="font-size-12 font-weight-500 mb-3">
                @csrf

                <!-- First Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">{{ __('Име') }}</label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="example@example.com" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label for="last_name" class="form-label">{{ __('Презиме') }}</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="example@example.com" value="{{ old('last_name') }}" autocomplete="last_name">
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Адреса') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="example@example.com" value="{{ session('registration_data.email') }}" autocomplete="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Лозинка') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="example@example.com" name="password" value="{{ session('registration_data.password') }}" autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Повтори лозинка') }}</label>
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="example@example.com" name="password_confirmation" autocomplete="new-password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Newsletter Checkbox -->
                <div class="newsletter d-flex align-items-center justify-content-start mb-3 form-check ms-0">
                    <input class="form-check-input me-2 p-0" type="checkbox" name="newsletter" id="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                    <label class="form-check-label mt-1 p-0 font-size-10" for="newsletter">{{ __('Испраќај ми известувања за нови зделки и промоции.') }}</label>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-primary h1 fw-bold bg-dark w-75">{{ __('Регистрирај се') }}</button>
                </div>
            </form>
            <p class="font-size-10">Со важата регистрација се согласувате со <span class="text-decoration-underline fw-bold">Правилата и Условите </span>за кориснички сајтови</p>
        </div>
    </div>
</div>

@endsection