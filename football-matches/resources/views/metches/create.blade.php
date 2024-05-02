<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Create new Metch</p>
                </div>
                <div class="p-3">
                    <form method="post" action="{{ route('metches.store') }}" class="fs-5">
                        @csrf

                        <div class="mb-3">
                            <label for="home_team_id">Home Team</label>
                            <select id="home_team_id" name="home_team_id" class="fs-5">
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('home_team_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('home_team_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="guest_team_id">Guest Team</label>
                            <select id="guest_team_id" name="guest_team_id" class="fs-5">
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('guest_team_id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('guest_team_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control fs-5" id="date" name="date" min="{{ $minDate }}" value="{{ old('date') }}">
                            @error('date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn text-white fs-5" style="background-color: #38C172;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
