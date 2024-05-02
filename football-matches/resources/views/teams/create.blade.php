<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Create new Team</p>
                </div>
                <div class="p-3">
                    <form method="post" action="{{ route('teams.store') }}" class="fs-5">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control rounded" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year_of_foundation" class="form-label">Year Founded</label>
                            <input type="number" class="form-control rounded" id="year_of_foundation" name="year_of_foundation" max="{{ date('Y') }}" value="{{ old('year_of_foundation') }}">
                            @error('year_of_foundation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn text-white fs-5" style="background-color: #38C172;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
