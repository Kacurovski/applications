@extends('layouts.app')

@section('sidebar')
@include('partials.sidebar')
@endsection

@vite(['resources/css/app.css', 'resources/js/api/fetch_brands_and_discounts.js'])

@section('search')
@include('partials.search')
@endsection

@section('content')
<div class="container-fluid m-0 p-0">
    <div class="text-end mb-4">
        <a href="{{ route('discounts.create') }}" class="text-decoration-none text-secondary font-size-15">
            Додај нов попуст <img src="{{ asset('images/ic_round-plus.png') }}" alt="">
        </a>
    </div>
    @if(session('success'))
    <div class="alert border border-success font-size-13 color-fancy-olive font-weight-500 p-2">
        {{ session('success') }}
    </div>
    @endif

    <p class="font-size-15 font-weight-500">Активни</p class="font-size-15 font-weight-500">
    <div class="active-container mb-4">
        <p class="loading">Loading...</p>
    </div>

    <p class="font-size-15 font-weight-500 color-grey">Архива</p class="font-size-15 font-weight-500">
    <div class="archived-container mb-4 color-grey">
        <p class="loading">Loading...</p>
    </div>
</div>
<!-- <script>
        document.querySelectorAll('.delete-discount').forEach(button => {
            button.addEventListener('click', function() {
                const discountId = this.getAttribute('data-id');
                const row = this.closest('.product-item');

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
                        axios.delete(`api/discounts/${discountId}`)
                            .then(() => {
                                row.remove(); 
                                Swal.fire(
                                    'Deleted!',
                                    'The discount has been deleted.',
                                    'success'
                                );
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the discount.',
                                    'error'
                                );
                                console.error(error);
                            });
                    }
                });
            });
        });
    </script> -->
@endsection