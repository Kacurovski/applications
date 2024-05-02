<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 border p-0">
                <div class="p-3 border-bottom mb-3" style="background-color: #F0F0F0;">
                    <p class="h5 fw-normal m-0">Metches</p>
                </div>
                <div class="p-3">
                    @can('admin')
                    <div class="d-flex justify-content-end mb-1">
                        <a href="{{ route('metches.create') }}" class="btn btn-lg text-white" style="background-color: #3490DC;">Add new Metch</a>
                    </div>
                    @endcan
                    @if (session('message'))
                    <div class="alert alert-success mt-4 mb-0 w-75 mx-auto" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    <table class="table fs-5"> 
                        <thead>
                            <tr>
                                <th scope="col py-3">Team 1</th>
                                <th scope="col py-3">Team 2</th>
                                <th scope="col py-3">Result</th>
                                @can('admin')
                                <th scope="col py-3"></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($metches) > 0)
                            @foreach($metches as $metch)
                            <tr class="border-0 border-top">
                                <td class="border-0 border-top py-3">{{ optional($metch->homeTeam)->name ?? 'N/A' }}</td>
                                <td class="border-0 border-top py-3">{{ optional($metch->guestTeam)->name ?? 'N/A' }}</td>
                                <td class="border-0 border-top py-3">{{ $metch->result ?: '/' }}</td>
                                @can('admin')
                                <td class="border-0 border-top py-3">
                                    <a href="{{ route('metches.edit', $metch->id) }}" class="me-2" style="color: #3490DC;">Edit</a>
                                    <form action="{{ route('metches.destroy', $metch->id) }}" method="POST" class="d-inline" style="color: #3490DC;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center border-0 text-secondary fst-italic">No matches found.</td>
                            </tr>
                            @endif
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>