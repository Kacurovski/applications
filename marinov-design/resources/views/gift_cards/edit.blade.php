<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-6/12 mx-auto rounded shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-xl font-bold mb-4">Edit Gift Card</h1>
                <form action="{{ route('gift-cards.update', $giftCard->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                        <input type="text" name="code" id="code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" value="{{ old('code', $giftCard->code) }}">
                    </div>

                    <div class="mb-6">
                        <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                        <input type="text" name="value" id="value" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3" value="{{ old('value', $giftCard->value) }}">
                    </div>

                    <div class="mb-6">
                        <label for="is_redeemed" class="block text-sm font-medium text-gray-700">Is Redeemed</label>
                        <select name="is_redeemed" id="is_redeemed">
                            <option value="1" {{ old('is_redeemed', $giftCard->is_redeemed) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_redeemed', $giftCard->is_redeemed) == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == old('user_id', $giftCard->user_id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white py-2 px-4 rounded">Update Gift Card</button>
                        <a href="{{ route('gift-cards.index') }}" class="inline-block text-gray-600 font-semibold py-2 px-4 rounded border border-gray-300 hover:bg-gray-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
