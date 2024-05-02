<x-app-layout>

    <div class="relative bg-white overflow-x-auto w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Coupons</h1>
        </div>
        <div class="text-right pb-8 border-b w-11/12 mx-auto">
            <div class="mt-9">
                <a href="{{ route('coupons.create') }}"
                    class="bg-green-400 hover:bg-green-600 text-white py-3 px-4 rounded">Add new Coupon</a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
            <div class="grid  grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($coupons as $coupon)
                    <div
                        class="flex flex-col relative justify-center items-center gap-2 border-2 border-dashed border-gray-500/50 p-4 rounded-md h-32 dark:text-black">
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                            class="absolute top-0 right-0 mt-2 mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="black" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>

                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="absolute top-0 left-0 mt-2 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.207l-4 1 1-4 11.732-11.732z" />
                            </svg>
                        </a>
                        <div class="flex gap-2 items-center">
                            <span class="font-bold text-3xl md:text-4xl">
                                {{ $coupon->discount }}
                            </span>
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 11q-1.45 0-2.475-1.025T4 7.5q0-1.45 1.025-2.475T7.5 4q1.45 0 2.475 1.025T11 7.5q0 1.45-1.025 2.475T7.5 11m0-2q.625 0 1.063-.437T9 7.5q0-.625-.437-1.062T7.5 6q-.625 0-1.062.438T6 7.5q0 .625.438 1.063T7.5 9m9 11q-1.45 0-2.475-1.025T13 16.5q0-1.45 1.025-2.475T16.5 13q1.45 0 2.475 1.025T20 16.5q0 1.45-1.025 2.475T16.5 20m0-2q.625 0 1.063-.437T18 16.5q0-.625-.437-1.062T16.5 15q-.625 0-1.062.438T15 16.5q0 .625.438 1.063T16.5 18M5.4 20L4 18.6L18.6 4L20 5.4z">
                                </path>
                            </svg>
                        </div>
                        <div class="p-1 border border-black rounded">
                            <p class="text-sm text-center font-semibold px-2">Code: {{ $coupon->code }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>
