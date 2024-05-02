@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/api/fetch_brands_and_discounts.js'])

@section('sidebar')
@include('partials.sidebar')
@endsection

@section('search')
@include('partials.search')
@endsection

@section('content')
<div class="container-fluid m-0 p-0">
    <div class="text-end mb-4">
        <a href="{{ route('brands.create') }}" class="text-decoration-none font-size-15 color-dark-grey">
            Додај нов бренд <img src="{{ asset('images/ic_round-plus.png') }}" alt="">
        </a>
    </div>

    @if(session('success'))
    <div class="alert border border-success font-size-13 color-fancy-olive font-weight-500 p-2">
        {{ session('success') }}
    </div>
    @endif

    <p class="font-size-15 font-weight-500">Активни</p>
    <div class="mb-4 active-container">
        <p class="loading">Loading...</p>

    </div>

    <p class="font-size-15 font-weight-500 color-grey">Архива</p>
    <div class="mb-4 archived-container color-grey">
        <p class="loading">Loading...</p>
    </div>
</div>
@endsection

<!-- <script>
    document.querySelectorAll('.delete-brand').forEach(button => {
        button.addEventListener('click', function() {
            const brandId = this.getAttribute('data-id');
            const brandItem = this.closest('.product-item');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/brands/${brandId}`)
                        .then(() => {
                            brandItem.remove();
                            Swal.fire(
                                'Deleted!',
                                'The brand has been deleted.',
                                'success'
                            );
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the brand.',
                                'error'
                            );
                            console.error(error);
                        });
                }
            });
        });
    });
</script> -->