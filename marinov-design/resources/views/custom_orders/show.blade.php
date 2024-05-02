<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <div class="relative bg-white overflow-x-auto w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Custom Order Details</h1>
        </div>
        <div class="w-11/12 mx-auto my-8 p-4 border rounded">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-lg font-semibold">{{ $customOrder->user->name }}</h2>
                    <p class="text-gray-600">{{ $customOrder->user->email }}</p>
                </div>
                <div>
                    <p>{{ $customOrder->created_at }}</p>
                </div>
            </div>
            <p class="mt-2">Message: {{ $customOrder->message }}</p>
                @if ($customOrder->images)
                    <div class="mt-2">
                        <p>Custom order images:</p>
                        <div class="flex justify-center">
                            @foreach (json_decode($customOrder->images) as $image)
                                <a data-fancybox="gallery" href="{{ asset('images/' . $image) }}">
                                    <img src="{{ asset('images/' . $image) }}" alt="{{ $image }}" class="w-96 h-96 object-cover mr-2">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            <p class="mt-5">Link for custom order: <a href="{{ $customOrder->send_link }}" class="text-blue-600"> {{ $customOrder->send_link }}</a></p>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("[data-fancybox]").fancybox();
        });
    </script>
</x-app-layout>
