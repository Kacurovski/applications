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
            <form method="POST" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data" id="submit_form" class="font-size-15">
                @csrf
                @method('PUT')
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
                            <option value="{{ $status->id }}" {{ $brand->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name === 'active' ? 'активен' : ($status->name === 'archived' ? 'архивиран' : $status->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Име на бренд</label>
                    <input type="text" class="custom-input form-control shadow-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $brand->name) }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea class="custom-input form-control shadow-sm @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Ознаки:</label>
                    <input type="hidden" name="tags[]" class="form-control shadow-sm @error('tags') is-invalid @enderror">
                    <div>
                        <input name='input-custom-dropdown' class="form-control shadow-sm @error('input-custom-dropdown') is-invalid @enderror" value="{{ $brand->tags->pluck('name')->implode(', ') }}">
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
                            @foreach ($brand->images as $image)
                            <div class="position-relative me-3 image-upload-view " style="background-image: url(' {{ asset('storage/' . $image->image_path) }}')" data-image="{{$image->image_path}}">
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

                <div class="mb-3">
                    <label for="categories" class="form-label">Категории:</label>
                    <select class="form-select select2 @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(collect(old('categories', $brand->categories->pluck('id')))->contains($category->id)) selected @endif>
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
                    <a href="{{ route('brands.index') }}" class="w-25 border-0 bg-white text-dark text-decoration-underline font-size-15 font-weight-500 mt-2">Одкажи</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        let input = document.querySelector('input[name="input-custom-dropdown"]');
        let tagsInput = document.querySelector('input[name="tags[]"]');
        let loading = document.querySelector('.loading');
        let tagsArray = [];
        let tagify;

        loading.innerHTML = "Loading...";
        input.style.display = "none";

        tagsInput.value = input.defaultValue;

        axios.get('/api/tags')
            .then(response => {
                loading.innerHTML = "";
                input.style.display = "block";

                const tags = response.data.map(tag => tag.name);

                tagify = new Tagify(input, {
                    whitelist: tags,
                    maxTags: 10,
                    dropdown: {
                        maxItems: 20,
                        classname: "tags-look",
                        enabled: 0,
                        closeOnSelect: false
                    }
                });

                tagify.on('add', updateTagsInput);
                tagify.on('remove', updateTagsInput);

            })
            .catch(error => {
                console.error('Error fetching tags:', error);
                input.placeholder = 'Error fetching tags';
            });

        function updateTagsInput(e) {
            tagsArray = tagify.value.map(tag => tag.value);
            tagsInput.value = tagsArray.join(',');
        }

    });
</script> -->
@endsection