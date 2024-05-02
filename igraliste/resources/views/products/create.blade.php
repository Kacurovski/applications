@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/css/forms/global.css',
'resources/css/forms/products.css',
'resources/js/forms/input_handlers',
'resources/js/forms/product_input_handlers.js'
])


@section('scripts')
@include('partials.scripts')
@endsection

@section('content')
<div class="container p-4">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" id="submit_form" class="font-size-15">
                @csrf
                @if(session('error'))
                <div class="alert border border-success font-size-13 color-fancy-olive font-weight-500 p-2">
                    {{ session('error') }}
                </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('homepage') }}" class="me-2">
                            <img src="{{ asset('images/arrow-left.png') }}" alt="Back" style="vertical-align: middle;">
                        </a>
                        <p class="mb-0 py-1 h5 fw-bold" style="vertical-align: middle;">Продукт</p>
                    </div>
                    <div>
                        <select class="form-select font-size-15 shadow-sm" id="status" name="status_id">
                            <option value="" disabled selected>Статус</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Име на продукт</label>
                    <input type="text" class="form-control custom-input shadow-sm" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea class="form-control shadow-sm custom-input" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="form-control custom-input shadow-sm" id="price" name="price" value="{{ old('price') }}">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label font-size-15">Количина:</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn decrement" type="button" id="button-decrement">-</button>
                        <input type="text" class="quantity-input border-0 h4 fw-normal pt-3 px-0" id="quantity" name="quantity" value="{{ old('quantity', 0) }}">
                        <button class="quantity-btn increment" type="button" id="button-increment">+</button>
                    </div>
                    @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sizes" class="form-label">Величина:</label>
                    <div id="sizes">
                        @foreach($sizes as $size)
                        <input type="radio" class="btn-check" name="size_id" id="size_{{ $size->id }}" autocomplete="off" value="{{ $size->id }}" @if(old('size_id')==$size->id) checked @endif hidden>
                        <label class="btn bg-light color-dark border-0 size-btn font-size-15 rounded-3" for="size_{{ $size->id }}">{{ $size->name }}</label>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="care" class="form-label">Совет за величина:</label>
                        <textarea class="form-control shadow-sm custom-input" id="care" name="size_advice" rows="2">{{ old('size_advice') }}</textarea>
                        @error('care')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Боја:</label>
                        <div class="color-selector">
                            @foreach($colors as $color)
                            <input type="radio" id="color_{{ $color->id }}" name="color_id" value="{{ $color->id }}" class="d-none" @if(old('color_id')==$color->id) checked @endif>
                            <label for="color_{{ $color->id }}" class="color-label rounded" style="background-color: {{ $color->hex_code }}"></label>
                            @endforeach
                        </div>
                        @error('color_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Ознаки:</label>
                        <input type="hidden" name="tags[]" class="form-control shadow-sm @error('tags') is-invalid @enderror">
                        <div>
                            <input name='input-custom-dropdown' class="form-control custom-input font-size-13 shadow-sm @error('input-custom-dropdown') is-invalid @enderror" value='{{ old('input-custom-dropdown') }}'>
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
                                <!-- Preview images -->
                                <label class="custom-file-upload">
                                    <input type="file" id="images" name="images[]" multiple />
                                    <i class="fas fa-plus border-0" aria-hidden="true"></i>
                                </label>
                            </div>

                        </div>
                        @error('images')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="brand" class="form-label">Бренд:</label>
                            <select class="form-select font-size-15 shadow-sm" id="brand" name="brand_id">
                                <option value="">Одбери</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="category" class="form-label">Категорија:</label>
                            <select class="form-select font-size-15 shadow-sm" id="category" name="category_id" disabled>
                                <option value="">Одбери</option>
                                @foreach($categories as $category)
                                <option class="category-option" value="{{ $category->id }}" data-brand-ids="@foreach($category->brands as $brand){{ $brand->id }} @endforeach" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-dark w-75 fw-bold rounded font-size-15 me-4">Зачувај</button>
                        <a href="{{ route('products.index') }}" class="w-25 border-0 bg-white text-dark text-decoration-underline font-size-15 font-weight-500 mt-2">Одкажи</a>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection