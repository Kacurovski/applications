<x-app-layout>
@if (session('message'))
        <div class="alert alert-success mt-4 mb-0 w-75 mx-auto" role="alert">
            {{ session('message') }}
        </div>
        @endif
    <div class="container mx-auto px-16">
        <h2 class="text-4xl text-gray-800 leading-tight text-center mt-3">
            Welcome to the forum
        </h2>
        <div class="mt-5 mb-4">
            <div class="mb-2">
                <a href="{{ route('discussion.create') }}" class="bg-gray-500 text-white py-2 px-4 rounded inline-block text-sm font-normal">Add new discussion</a>
            </div>

            @if(auth()->check() && auth()->user()->role == 'admin')
            <div>
                <a href="{{ route('discussion.approve') }}" class="bg-blue-400 text-black text-sm py-2 px-4 rounded inline-block font-normal">Approve discussions</a>
            </div>
            @endif
        </div>
        <div class="row">
            @if($discussions->isEmpty())
            <p class="text-center text-gray-500 text-2xl mt-4">Nothing here yet! Start a topic!</p>
            @else
            @foreach($discussions as $discussion)
            <div class="col-12 bg-white border px-5 py-4 mb-3">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('discussion.show', $discussion->id) }}">
                            <div class="d-flex">
                                <div class="mr-5">
                                    @if ($discussion->picture)
                                    <img src="{{ asset('storage/images/' . $discussion->picture) }}" style="width: 100px; height:50px" alt="Discussion Image">
                                    @else
                                    <span>No image available</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-2xl">{{ $discussion->title }}</h3>
                                    <p class="text-gray-500">{{ $discussion->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            @auth
                            @if(auth()->user()->id === $discussion->user->id)
                            <div class="me-3">
                                <a href="{{ route('discussion.edit', $discussion->id) }}" class="text-black"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('discussion.destroy', $discussion->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                            @endif
                            @endauth
                            <p>
                                <span>{{ $discussion->category->name }}</span>
                                |
                                <span>{{ $discussion->user->username }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>