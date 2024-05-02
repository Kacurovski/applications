<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Create Gift Card</h1>

                <form action="{{ route('gift-cards.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-700">Gift Card Code</label>
                        <input type="text" name="code" id="code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-6">
                        <label for="value" class="block text-sm font-medium text-gray-700">Gift Card Value</label>
                        <input type="text" name="value" id="value" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" required>
                    </div>

                    <div class="mb-6">
                        <label for="is_redeemed" class="block text-sm font-medium text-gray-700">Is Redeemed</label>
                        <select name="is_redeemed" id="is_redeemed" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User (optional)</label>
                        <select name="user_id" id="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                            <option value="" selected>Select User (optional)</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Gift Card</button>
                        <a href="{{ route('gift-cards.index') }}" class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
