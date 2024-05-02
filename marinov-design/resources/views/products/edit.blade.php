<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Edit Product</h1>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $product->title }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" value="{{ $product->sale_price }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="is_featured" class="block text-sm font-medium text-gray-700">Featured</label>
                            <select name="is_featured" id="is_featured"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option value="1" {{ $product->is_featured ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$product->is_featured ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="dimensions" class="block text-sm font-medium text-gray-700">Dimensions</label>
                            <input type="text" name="dimensions" id="dimensions" value="{{ $product->dimensions }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="type_id" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type_id" id="type_id"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $type->id === $product->type_id ? 'selected' : '' }}>{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                            <input type="number" name="weight" id="weight" value="{{ $product->weight }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="is_discounted"
                                class="block text-sm font-medium text-gray-700">Discounted</label>
                            <select name="is_discounted" id="is_discounted"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option value="1" {{ $product->is_discounted ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$product->is_discounted ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Materials</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($materials as $material)
                                <div class="flex items-center">
                                    <input type="checkbox" name="materials[]" id="material{{ $material->id }}"
                                        value="{{ $material->id }}" class="mr-2"
                                        {{ $product->materials->contains($material->id) ? 'checked' : '' }}>
                                    <label for="material{{ $material->id }}"
                                        class="text-sm">{{ $material->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maintenances</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($maintenances as $maintenance)
                                <div class="flex items-center">
                                    <input type="checkbox" name="maintenances[]"
                                        id="maintenance{{ $maintenance->id }}" value="{{ $maintenance->id }}"
                                        class="mr-2"
                                        {{ $product->maintenances->contains($maintenance->id) ? 'checked' : '' }}>
                                    <label for="maintenance{{ $maintenance->id }}"
                                        class="text-sm">{{ $maintenance->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Images</label>
                        <input type="file" name="images[]" multiple>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                        <div class="flex flex-wrap">
                            @foreach ($product->images as $image)
                                <div class="w-24 h-24 mr-2 mb-2 relative">
                                    <button class="delete-btn bg-red-500 px-2 rounded-full text-white absolute end-0 top-1 right-1"
                                        data-type-image="{{ $image->id }}"><p class="m-0">X</p></button>
                                    <img src="{{ $image->image }}" alt="Product Image"
                                        class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-8 flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-400 hover:bg-blue-600 text-white py-3 px-4 rounded">Update Product</button>

                        <a href="{{ route('products.index') }}"
                            class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>


        <script>
            const deleteBtn = document.querySelectorAll('.delete-btn');
            deleteBtn.forEach(btn => {
                const imageId = btn.getAttribute('data-type-image');

                btn.addEventListener('click', (e) => {
                    e.preventDefault()
                    axios.delete(`/api/imageDelete/${imageId}`)
                        .then(response => {
                            if (response.data.success) {
                                btn.closest('div').remove();
                            } else {
                                console.error('Error deleting user:', response.data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting user:', error);
                        });
                })
            })
        </script>
</x-app-layout>
