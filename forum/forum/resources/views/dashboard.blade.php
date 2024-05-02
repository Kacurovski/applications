<x-app-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Welcome to the forum
    </h2>
    <div class="py-12">
        <a href="{{ route('discussion.create') }}" class="text-black">Add discussion</a>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('discussion.approve') }}" class="text-black ml-4">Approve discussions</a>
        @endif
    </div>

    <div class="container mx-auto">
        @foreach($discussions as $discussion)
        <a href="{{ route('discussion.show', $discussion->id) }}" class="block mb-4 p-4 border rounded hover:bg-gray-100">
            <h3 class="text-lg font-semibold">{{ $discussion->title }}</h3>
            <p>{{ $discussion->description }}</p>
            <p>Category: {{ $discussion->category->name }}</p>
            <p>Posted by: {{ $discussion->user->name }}</p>
        </a>
        @endforeach
    </div>

</x-app-layout>