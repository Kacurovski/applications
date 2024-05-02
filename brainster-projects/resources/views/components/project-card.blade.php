<div class="card-holder col-12 col-md-6 col-lg-4 mb-3 position-relative px-4 px-md-3">
    @if(request()->routeIs('projects.index'))
    <a href="{{ $project->URL }}" target="_blank" class="text-decoration-none">
        @endif
        <div class="border h-100 card-box rounded d-flex flex-column">
            <div class="d-flex flex-column mt-3">
                <div class="text-center">
                    <img src="{{ $project->image }}" alt="image of the project" class="w-25">
                </div>
                <div class="text-center d-flex flex-column px-md-3">
                    <p class="h4 text-secondary editable">{{ $project->name }}</p>
                    <p class="text-secondary editable">{{ $project->subtitle }}</p>
                    <p class="editable text-dark">{{ $project->description }}</p>
                </div>
            </div>

            @if(request()->routeIs('projects.editMode'))
            <div class="card-buttons mt-auto">
                <button class="btn btn-lg border border-dark p-3 m-2" onclick="editMode(event)" data-bs-target="edit"><i class="fa-solid fa-pen fa-xl"></i></button>
                <button class="btn btn-lg border border-dark p-3 m-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}"><i class="fa-solid fa-x fa-xl text-dark"></i></button>
            </div>
            @endif
        </div>
        <div>
            <form action="{{ route('projects.update', $project->id) }}" method="POST" class="card-form d-none h-100">
                @csrf
                @method('patch')
                <div>
                    <label for="url" class="form-label">Url</label>
                    <input type="text" name="url" class="form-control mb-2" value="{{ $project->URL }}">

                    <label for="image" class="form-label">Image</label>
                    <input type="text" name="image" class="form-control mb-2" value="{{ $project->image }}">

                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control mb-2" value="{{ $project->name }}">

                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control mb-2" value="{{ $project->subtitle }}">

                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="2">{{ $project->description }}</textarea>
                </div>
                <div class="edit-buttons d-flex justify-content-center py-3 mt-5 border-top border-secondary">
                    <button type="submit" class="btn border border-secondary me-2">Зачувај</button>
                    <button type="button" class="close-form btn border border-secondary">Одкажи</button>
                </div>
            </form>
        </div>
        @if(request()->routeIs('projects.index'))
    </a>
    @endif

</div>

@include('components.delete-modal')