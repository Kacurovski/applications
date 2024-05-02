@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/forms/brands.css',
'resources/css/forms/global.css',
'resources/js/forms/input_handlers.js',
])

@section('scripts')
@include('partials.scripts')
@endsection

@section('content')

<div class="container p-4">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data" id="submit_form" class="font-size-15">
                @csrf

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('brands.index') }}" class="me-2">
                            <img src="{{ asset('images/arrow-left.png') }}" alt="Back" style="vertical-align: middle;">
                        </a>
                        <p class="mb-0 py-1 h5 fw-bold" style="vertical-align: middle;">Бренд</p>
                    </div>
                    <div>
                        <select class="form-select font-size-15 shadow-sm" id="status" name="status_id">
                            <option value="" disabled selected>Статус</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->name === 'active' ? 'активен' : ($status->name === 'archived' ? 'архивиран' : $status->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('status_id')
                <div class="text-danger text-end mt-n1">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="name" class="form-label">Име на бренд</label>
                    <input type="text" class="custom-input form-control shadow-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea class="custom-input form-control shadow-sm @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Ознаки:</label>
                    <input type="hidden" name="tags[]" class="custom-input form-control shadow-sm @error('tags') is-invalid @enderror">
                    <div>
                        <input name='input-custom-dropdown' class="form-control shadow-sm @error('input-custom-dropdown') is-invalid @enderror">
                        <span class="loading fw-bold text-danger"></span>
                    </div>
                    @error('tags')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label d-block">Слики:</label>
                    <div class="d-flex">
                        <div class="preview-container mt-2 d-flex flex-wrap">
                            <label class="custom-file-upload">
                                <input type="file" id="images" name="images[]" multiple />
                                <i class="fas fa-plus border-0" aria-hidden="true"></i>
                            </label>
                        </div>

                    </div>
                    @error('images')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Категории:</label>
                    <select class="form-select shadow-sm rounded-3 select2 @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-dark w-75 fw-bold rounded me-4 font-size-15">Зачувај</button>
                    <a href="{{ route('brands.index') }}" class="w-25 border-0 bg-white text-dark text-decoration-underline font-size-15 font-weight-500 mt-2">Одкажи</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection