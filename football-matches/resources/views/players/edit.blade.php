<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Edit Player</p>
                </div>
                <div class="p-3">
                    <form method="post" action="{{ route('players.update', $player->id) }}" class="fs-5">
                        @csrf
                        @method('PUT') 

                        <div class="mb-3">
                            <label for="name" class="form-label">Player Name</label>
                            <input type="text" class="form-control rounded" id="name" name="name" value="{{ old('name', $player->name) }}" required>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="surname" class="form-label">Player Surname</label>
                            <input type="text" class="form-control rounded" id="surname" name="surname" value="{{ old('surname', $player->surname) }}" required>
                            @error('surname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control rounded fs-5" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $player->date_of_birth) }}" required>
                            @error('date_of_birth')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="team_id" class="form-label rounded">Team</label>
                            <select class="form-select rounded fs-5" id="team_id" name="team_id" required>
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn text-white fs-5" style="background-color: #38C172;">Update Player</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
