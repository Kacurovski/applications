<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Create Product</h1>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="is_featured" class="block text-sm font-medium text-gray-700">Featured</label>
                            <select name="is_featured" id="is_featured"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="dimensions" class="block text-sm font-medium text-gray-700">Dimensions</label>
                            <input type="text" name="dimensions" id="dimensions"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="type_id" class="block text-sm font-medium text-gray-700">Type</label>
                            <select disabled name="type_id" id="type_id"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option disabled selected>Select Type</option>
                                @foreach ($types as $type)
                                    <option data-type-category="{{ $type->category_id }}" value="{{ $type->id }}"
                                        class="category_types">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                            <input type="number" name="weight" id="weight"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="is_discounted"
                                class="block text-sm font-medium text-gray-700">Discounted</label>
                            <select name="is_discounted" id="is_discounted"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Materials</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($materials as $material)
                                <div class="flex items-center">
                                    <input type="checkbox" name="materials[]" id="material{{ $material->id }}"
                                        value="{{ $material->id }}" class="mr-2">
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
                                        class="mr-2">
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
                    <div class="mt-8 flex justify-between items-center">
                        <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white py-3 px-4 rounded">Add
                            Product</button>

                        <a href="{{ route('products.index') }}"
                            class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const selectCategory = document.querySelector('#category_id');
        const categoryTypes = document.querySelectorAll('.category_types');

        selectCategory.addEventListener('change', (e) => {
            const selectedCategory = e.target.value;
            const typeId = document.querySelector('#type_id');

            typeId.removeAttribute('disabled');

            categoryTypes.forEach(category => {
                const categoryAtt = category.getAttribute('data-type-category');
                categoryAtt !== selectedCategory ? category.setAttribute('hidden', true) : category
                    .removeAttribute('hidden')
            })
        })
    </script>
</x-app-layout>
