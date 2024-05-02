<div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center align-items-center h-100">
        <div class="modal-content center-vertical">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $project->id }}">Избриши</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="m-0">Дали сте сигурни дека сакате да го избришете производот?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Одкажи</button>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-warning">Избриши</button>
                </form>
            </div>
        </div>
    </div>
</div>