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
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" id="submit_form" class="font-size-15">
                @csrf
                @method('PUT')

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('homepage') }}" class="me-2">
                            <img src="{{ asset('images/arrow-left.png') }}" alt="Back" style="vertical-align: middle;">
                        </a>
                        <h2 class="mb-0 pb-1" style="vertical-align: middle;">Продукт</h2>
                    </div>
                    <div>
                        <select class="form-select form-size-15 shadow-sm" id="status" name="status_id">
                            <option value="" disabled>Select Status</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $product->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Име на продукт</label>
                    <input type="text" class="custom-input form-control shadow-sm" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea class="custom-input form-control shadow-sm" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="custom-input form-control shadow-sm" id="price" name="price" value="{{ old('price', $product->price) }}">
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Количина:</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn decrement" type="button" id="button-decrement">-</button>
                        <input type="text" class="quantity-input border-0 h4 pt-2 fw-normal p-0" id="quantity" name="quantity" value="{{$product->quantity}}">
                        <button class="quantity-btn increment" type="button" id="button-increment">+</button>
                    </div>
                </div>

                <!-- Sizes -->
                <div class="mb-3">
                    <label for="sizes" class="form-label">Величина:</label>
                    <div id="sizes">
                        @foreach($sizes as $size)
                        <input type="radio" class="btn-check" name="size_id" id="size_{{ $size->id }}" autocomplete="off" value="{{ $size->id }}" {{ $product->size_id == $size->id ? 'checked' : '' }}>
                        <label class="font-size-15 btn {{ $product->size_id == $size->id ? 'btn-success' : 'bg-light' }} rounded-3 color-dark border-0 size-btn" for="size_{{ $size->id }}">{{ $size->name }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="care" class="form-label">Совет за величина:</label>
                    <textarea class="custom-input form-control shadow-sm" id="care" name="size_advice" rows="2">{{ old('size_advice', $product->size_advice) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Боја:</label>
                    <div class="color-selector">
                        @foreach($colors as $color)
                        <input type="radio" id="color_{{ $color->id }}" name="color_id" value="{{ $color->id }}" class="d-none" {{ $product->color_id == $color->id ? 'checked' : '' }}>
                        <label for="color_{{ $color->id }}" class="color-label rounded" style="background-color: {{ $color->hex_code }};"></label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Ознаки:</label>
                    <input type="hidden" name="tags[]" class="form-control shadow-sm @error('tags') is-invalid @enderror">
                    <div>
                        <input name='input-custom-dropdown' class="custom-input form-control shadow-sm @error('input-custom-dropdown') is-invalid @enderror" value="{{ $product->tags->pluck('name')->implode(', ') }}">
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
                            @foreach ($product->images as $image)
                            <div class="position-relative me-3 image-upload-view " style="background-image: url('{{ asset('storage/' . $image->image_path) }}')" data-image="{{$image->image_path}}">
                                <i class="fa-solid fa-circle-xmark position-absolute end-0 top-0 close-icon" data-image="{{$image->image_path}}"></i>
                            </div>
                            @endforeach
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

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="brand" class="form-label">Бренд:</label>
                        <select class="form-select font-size-15 shadow-sm" id="brand" name="brand_id">
                            <option value="">Одбери</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
                            <option class="category-option" value="{{ $category->id }}" data-brand-ids="@foreach($category->brands as $brand){{ $brand->id }} @endforeach" value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-success w-75 me-4">Зачувај</button>
                    <a href="{{ route('products.index') }}" class="w-25 border-0 bg-white text-dark text-decoration-underline font-size-15 font-weight-500 mt-2">Одкажи</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection