<x-app-layout>
    <div class="relative bg-white overflow-x-auto w-full sm:w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg mx-auto text-gray-600 px-4 sm:px-0 sm:w-11/12">Gift Cards</h1>
        </div>
        <div class="text-right pb-8 border-b mx-auto px-4 sm:px-0 sm:w-11/12">
            <div class="mt-9">
                <a href="{{ route('gift-cards.create') }}"
                    class="bg-green-400 hover:bg-green-600 text-white py-3 px-4 rounded">Add new Gift Card</a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($giftCards as $giftCard)
                    <div
                        class="relative flex flex-col bg-gradient-to-r from-indigo-500 to-violet-500 text-white p-8 rounded-lg shadow-lg w-full min-w-0 break-words">
                        <!-- Delete button positioned as an icon on the top right -->
                        <form action="{{ route('gift-cards.destroy', $giftCard->id) }}" method="POST"
                            class="absolute top-0 right-0 mt-2 mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="white" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                        <!-- Edit button positioned as an icon on the top left -->
                        <a href="{{ route('gift-cards.edit', $giftCard->id) }}" class="absolute top-0 left-0 mt-2 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.207l-4 1 1-4 11.732-11.732z" />
                            </svg>
                        </a>
                        <div class="flex-grow">
                            <div class="text-3xl font-bold mb-4 text-center">Gift Card</div>
                            <div class="text-2xl mb-4 text-center"><span
                                    class="text-yellow-400 font-bold">{{ $giftCard->value }}</span>$</div>
                            <div class="text-base mb-4 text-center">Coupon code:</div>
                            <div
                                class="bg-white text-gray-800 rounded-lg px-4 py-2 flex items-center justify-center overflow-hidden">
                                <span class="text-sm font-semibold truncate"> {{ $giftCard->code }}</span>
                            </div>
                            <div class="text-sm mt-4 text-center truncate">
                                <p>Associated User: <span
                                        class="font-semibold">{{ $giftCard->user ? $giftCard->user->name : 'Not Associated' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
