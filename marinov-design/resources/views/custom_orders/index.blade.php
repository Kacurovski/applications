<x-app-layout>
    <div class="relative bg-white overflow-x-auto w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Custom Orders</h1>
        </div>
        <div class="w-11/12 mx-auto mt-8">
            @foreach ($customOrders as $customOrder)
                <div class="mb-4 p-4 border rounded">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $customOrder->user->name }}</h2>
                            <p class="text-gray-600">{{ $customOrder->user->email }}</p>
                        </div>
                        <div>
                            <p>{{ $customOrder->created_at }}</p>
                        </div>
                    </div>

                    <p class="mt-2">{{ $customOrder->message }}</p>

                    <a href="{{ route('custom-orders.show', $customOrder->id) }}" class="text-blue-400 hover:underline">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
