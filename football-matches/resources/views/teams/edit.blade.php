<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Edit Team</p>
                </div>
                <div class="p-3">
                    <form method="post" action="{{ route('teams.update', $team->id) }}" class="fs-5">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Team Name</label>
                            <input type="text" class="form-control rounded" id="name" name="name" value="{{ old('name', $team->name) }}" required>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year_of_foundation" class="form-label">Year of Foundation</label>
                            <input type="number" class="form-control rounded" id="year_of_foundation" name="year_of_foundation" value="{{ old('year_of_foundation', $team->year_of_foundation) }}" required>
                            @error('year_of_foundation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn text-white fs-5" style="background-color: #38C172;">Update Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
