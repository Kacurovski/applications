<x-app-layout>
    <div class="container py-3">
        <div class="row">
            <div class="col-6 offset-3">
            <form method="POST" action="{{ route('comment.store', ['discussion' => $discussion->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Comment</label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn text-white fw-normal" style="background-color: #1E90FF;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>