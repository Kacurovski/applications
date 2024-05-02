@extends('layouts.app')

@section('sidebar')
@include('partials.sidebar')
@endsection


@section('content')
<div class="container mt-5 p-0">
    <div class="row">
        <div class="col-md-6 p-3 mx-auto">
            <div class="bg-white rounded">
                <h5 class="fw-bold mb-4">Промена на лозинка</h4>
                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="old_password" class="form-label font-size-15">Стара Лозинка</label>
                        <input type="password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                        @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label font-size-15">Нова Лозинка</label>
                        <input type="password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label font-size-15">Потврди Лозинка</label>
                        <input type="password" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation">
                        @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark btn-block">Промени Лозинка</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@vite([
'resources/css/app.css'
])


@endsection