<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 bg-light border-bottom mb-3" style="background-color: #F0F0F0 !important;">
                    <p class="h5 fw-normal m-0">Players</p>
                </div>
                <div class="p-3">
                    <div class="d-flex justify-content-end mb-1">
                        <a href="{{ route('players.create') }}" class="btn btn-lg text-white" style="background-color: #3490DC;">Add new Player</a>
                    </div>
                    @if (session('message'))
                    <div class="alert alert-success mt-4 mb-0 w-75 mx-auto" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    <table class="table fs-5">
                        <thead>
                            <tr>
                                <th scope="col py-3">Name</th>
                                <th scope="col py-3">Date of Birth</th>
                                <th scope="col py-3">Team</th>
                                <th scope="col py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($players) > 0)
                            @foreach($players as $player)
                            <tr class="border-0 border-top">
                                <td class="border-0 border-top py-3">{{ $player->name }} {{ $player->surname }}</td>
                                <td class="border-0 border-top py-3">{{ $player->date_of_birth }}</td>
                                <td class="border-0 border-top py-3">{{ optional($player->team)->name ?? 'N/A' }}</td>
                                <td class="border-0 border-top py-3">
                                    <a href="{{ route('players.edit', $player->id) }}" class="me-2" style="color: #3490DC;">Edit</a>
                                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="d-inline" style="color: #3490DC;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center border-0 text-secondary fst-italic">No players found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>