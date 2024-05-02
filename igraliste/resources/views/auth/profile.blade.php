@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/css/pages/user_profile.css'])

@section('content')
<div class="welcome-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="logo-container mb-5">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </div>
                <div class="user-info">
                    @php
                        $userImage = auth()->user()->picture ? Storage::url(auth()->user()->picture) : asset('images/default-profile-image.png');
                    @endphp
                    <img src="{{ $userImage }}" alt="Profile Image" class="user-image img-thumbnail rounded-circle mb-3">
                    <h2 class="user-name">{{ auth()->user()->name }}</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-logout border border-2">Одјави се</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
