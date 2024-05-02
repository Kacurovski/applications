<x-app-layout>
    <div class="relative bg-white overflow-x-auto w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Maintenance & Care</h1>
        </div>
        <div class="text-right pb-8 border-b w-11/12 mx-auto">
            <div class="mt-9">
                <a href="{{ route('maintenances.create') }}" class="bg-green-400 hover:bg-green-600 text-white py-3 px-4 rounded">Add new Maintenance</a>
            </div>
        </div>
        <table class="w-11/12 mb-7 mt-2 mx-auto text-sm text-left text-gray-500">
            <thead class="text-lg text-gray-700 bg-white border-b-2">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Text
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                    <tr class="bg-white text-lg border-t">
                        <td class="px-6 py-4">{{ $maintenance->title }}</td>
                        <td class="px-6 py-4">{{ $maintenance->text }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-600 py-3 px-5 rounded mx-1">Edit</a>
                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-400 hover:bg-red-600 py-2 px-5 rounded mx-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
