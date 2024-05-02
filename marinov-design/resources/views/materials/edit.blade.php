<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Edit Material</h1>

                <form action="{{ route('materials.update', $material) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $material->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Material</button>
                        <a href="{{ route('materials.index') }}" class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
