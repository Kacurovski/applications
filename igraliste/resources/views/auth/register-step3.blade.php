@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/pages/register.css',
])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 text-center">
            <div class="logo-container text-center">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <form method="POST" action="{{ url('register/finalize') }}" enctype="multipart/form-data" novalidate>
                @csrf

                <label for="picture" class="custom-file-upload d-flex flex-column align-items-center">
                    <img id="image-preview" src="{{ asset('images/default-profile-image.png') }}" class="img-thumbnail mb-3" alt="Profile Image" />
                    <p class="font-size-12 custom-bg-grey custom-border-radius text-black font-weight-500">Одбери слика</p>
                </label>
                <input type="file" id="picture" name="picture" onchange="previewImage();" class="@error('picture') is-invalid @enderror">
                <div class="mb-3 text-start">
                    <label for="address" class="form-label font-size-15">Адреса</label>
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Адреса" value="{{ old('address') }}" required>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="phone" class="form-label font-size-15">Телефонски број</label>
                    <input type="tel" id="phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Телефонски број" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="bio" class="form-label font-size-15">Биографија</label>
                    <textarea id="bio" name="bio" class="form-control @error('bio') is-invalid @enderror" placeholder="Биографија" required>{{ old('bio') }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-column">
                    <button type="submit" class="btn w-75 font-size-15 bg-dark mb-2 text-white font-weight-500" name="action" value="finished">Заврши</button>
                    <button type="submit" class="text-start w-25 border-0 bg-white text-decoration-underline font-size-12 font-weight-500" name="action" value="skip">Прескокни</button>
                </div>
            </form>
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

