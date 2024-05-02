<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
        <div class="px-6 py-4">
            <h1 class="text-xl font-bold mb-4">Edit Maintenance Record</h1>
            <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" value="{{ old('title', $maintenance->title) }}">
                </div>

                <div class="mb-6">
                    <label for="text" class="block text-sm font-medium text-gray-700">Text</label>
                    <input type="text" name="text" id="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" value="{{ old('text', $maintenance->text) }}">
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white py-2 px-4 rounded">Update Maintenance</button>
                    <a href="{{ route('maintenances.index') }}" class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
