@extends('layouts.app')



@section('sidebar')
@include('partials.sidebar')
@endsection

@vite([
'resources/css/app.css',
'resources/css/pages/admin.css'
])

@section('content')
<div class="container p-2 mt-2">
    <div class="row">
        <div class="p-2 mx-auto">
            @if (session('success'))
            <div class="alert border border-success font-size-13 color-fancy-olive font-weight-500 p-2">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white rounded">
                <h1 class="h6 fw-bold mb-4">Мој профил</h1>
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="picture" class="custom-file-upload-admin d-flex flex-column p-0">
                        @php
                        $adminImage = auth()->user()->picture ? Storage::url(auth()->user()->picture) : asset('images/default-profile-image.png');
                        @endphp
                        <img id="image-preview" src="{{ $adminImage }}" class="img-thumbnail mb-3" alt="Profile Image" />
                        <p class="font-size-15 font-weight-500 text-decoration-underline color-fancy-olive cursor-pointer">Промени слика</p>
                    </label>
                    <input type="file" id="picture" name="picture" onchange="previewImage();" class="@error('picture') is-invalid @enderror">
                    @error('picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="name" class="form-label font-size-15">Име</label>
                        <input type="text" id="name" class="custom-input form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label font-size-15">Email адреса</label>
                        <input type="email" id="email" class="custom-input form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label font-size-15">Телефонски број</label>
                        <input type="text" id="phone_number" class="custom-input form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ auth()->user()->phone_number }}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2 form-label font-size-15">Лозинка</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" disabled name="password" placeholder="**********">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('admin.password.change') }}" class="font-size-13 font-weight-500 text-decoration-underline color-fancy-olive">Промени лозинка</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark btn-block">Зачувај</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImage() {
        let file = document.querySelector('input[type=file]').files[0];
        let reader = new FileReader();

        reader.onloadend = function() {
            document.getElementById('image-preview').src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').src = "";
        }
    }
</script>
@vite([
'resources/css/app.css',
'resources/css/pages/profile.css'
])
@endsection