@extends('layouts.app')
@vite([
'resources/css/app.css',
'resources/css/forms/discounts.css',
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
            <form method="POST" action="{{ route('discounts.update', $discount) }}" enctype="multipart/form-data" class="font-size-15" id="submit_form">
                @csrf
                @method('PUT')

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('discounts.index') }}" class="me-2">
                            <img src="{{ asset('images/arrow-left.png') }}" alt="Back" style="vertical-align: middle;">
                        </a>
                        <p class="mb-0 h5 fw-bold pb-1" style="vertical-align: middle;">Измени Попуст</p>
                    </div>

                    <div>
                        <select class="form-select font-size-15" id="status" name="status_id">
                            <option value="" disabled selected>Статус</option>
                            @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $discount->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name == 'active' ? 'активен' : ($status->name == 'archived' ? 'архивиран' : $status->name) }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Име на попуст / промо код</label>
                    <input type="text" class="custom-input form-control" id="name" name="name" value="{{ old('name', $discount->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="percent" class="form-label">Попуст</label>
                    <input type="text" class="custom-input form-control" id="percent" name="percent" value="{{ old('percent', $discount->percent) }}" required>
                </div>

                <div class="mb-3">
                    <label for="products" class="form-label">Постави попуст на:</label>
                    <div>
                        <input type="hidden" name="products[]" value=''>
                        <input name='pre-products' class='custom-input form-control some_class_name' value="{{ $productIds }}" data-blacklist='.NET,PHP'>
                        <span class="loading fw-bold text-danger"></span>
                    </div>
                    @error('products')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Категории:</label>
                    <select class="form-select select2 @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(collect(old('categories', $discount->discountCategories->pluck('id')))->contains($category->id)) selected @endif>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('categories')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-dark w-75 fw-bold rounded font-size-15 me-4">Зачувај</button>
                    <a href="{{ route('discounts.index') }}" class="w-25 border-0 bg-white text-dark text-decoration-underline font-size-15 font-weight-500 mt-2">Одкажи</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection