<x-app-layout>
    <div class="relative bg-white overflow-x-auto w-13/13 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Products</h1>
        </div>
        <div class="text-right pb-8 border-b w-11/12 mx-auto">
            <div class="mt-9">
                <a href="{{ route('products.create') }}"
                    class="bg-green-400 hover:bg-green-600 text-white py-3 px-4 rounded">Add new Product</a>
            </div>
        </div>
        <table class="w-11/12 mb-7 mt-2 mx-auto text-sm text-left text-gray-500">
            <thead class="text-lg text-gray-700 bg-white border-b-2">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Sale Price
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Featured
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Dimensions
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Weight
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Discount
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white text-lg border-t">
                        <td class="px-4 py-4">{{ $product->title }}</td>
                        <td class="px-4 py-4">{{ $product->description }}</td>
                        <td class="px-4 py-4">{{ $product->price }}</td>
                        <td class="px-4 py-4">{{ $product->sale_price }}</td>
                        <td class="px-4 py-4">{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-4">{{ $product->category->name }}</td>
                        <td class="px-4 py-4">{{ $product->dimensions }}</td>
                        <td class="px-4 py-4">{{ $product->type->name }}</td>
                        <td class="px-4 py-4">{{ $product->weight }}</td>
                        <td class="px-4 py-4">{{ $product->quantity }}</td>
                        <td class="px-4 py-4">{{ $product->is_discounted ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-4 flex">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="text-white bg-yellow-400 hover:bg-yellow-600 py-2 px-4 rounded mx-1">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-400 hover:bg-red-600 py-2 px-4 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
