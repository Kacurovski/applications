<x-app-layout>
    @if (session('message'))
    <div class="alert alert-success mt-4 mb-0 w-75 mx-auto" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <p class="h2 fw-normal text-center mt-3 mb-5">Welcome to the forum</p>
    <div class="container mb-4">
        <div class="row">
            <div class="col-10 offset-1 bg-white border px-4 py-5">
                <div class="text-muted text-end mb-3">
                    <p>
                        <span>{{ $discussion->category->name }}</span>
                        |
                        <span>{{ $discussion->user->username }}</span>
                    </p>
                </div>
                <div class="test d-flex align-items-center flex-column w-75 mx-auto">
                    @if ($discussion->picture)
                    <div style="min-width: 100%; width: 100%;">
                        <img src="{{ asset('storage/images/' . $discussion->picture) }}" class="w-100" style="min-width: 100%;" alt=" Discussion Image">
                    </div>
                    @else
                    <span>No image available</span>
                    @endif
                    <div class="me-auto mt-5">
                        <p class="h2 fw-normal">{{ $discussion->title }}</p>
                        <p class="text-muted">{{ $discussion->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-0">
        <div class="row">
            <div class="col-10 offset-1">
                <p class="h3 mb-4 ms-3">Comments:</p>
                @auth
                <a href="{{ route('comment.create', ['discussion' => $discussion->id]) }}" class="btn btn-sm btn-secondary mb-4 ms-3">Add a comment</a>
                @endauth
                @foreach ($comments as $comment)
                <div class="bg-white border p-3 mb-2">
                    <div>
                        <div class="d-flex justify-content-between">
                            <p class="mb-1">{{ $comment->user->username }} says: </p>
                            <p class="text-muted"> {{ $comment->user->created_at }} </p>
                        </div>
                        <div class="d-flex">
                            <p class="me-3">{{ $comment->content }}</p>
                            @auth
                            @if(auth()->user()->id === $comment->user->id)
                            <div class="d-flex">
                                <a href="{{ route('comment.edit', ['discussion' => $discussion->id, 'comment' => $comment->id]) }}" class="mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('comment.destroy', ['comment' => $comment->id, 'discussion' => $discussion->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>