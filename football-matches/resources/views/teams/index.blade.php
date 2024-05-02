<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Teams</p>
                </div>
                <div class="p-3">
                    <div class="d-flex justify-content-end mb-1">
                        <a href="{{ route('teams.create') }}" class="btn btn-lg text-white" style="background-color: #3490DC;">Add new Team</a>
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
                                <th scope="col py-3">Year Founded</th>
                                <th scope="col py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($teams) > 0)
                            @foreach($teams as $team)
                            <tr class="border-0 border-top">
                                <td class="border-0 border-top py-3">{{ $team->name }}</td>
                                <td class="border-0 border-top py-3">{{ $team->year_of_foundation }}</td>
                                <td class="border-0 border-top py-3">
                                    <a href="{{ route('teams.edit', $team->id) }}" class="me-2" style="color: #3490DC;">Edit</a>
                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="d-inline" style="color: #3490DC;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center border-0 text-secondary fst-italic">No teams found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>