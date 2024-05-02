@extends('layouts.app')

@vite([
'resources/css/app.css',
'resources/js/api/fetch_products.js'
])

@section('sidebar')
@include('partials.sidebar')
@endsection

@section('search')
@include('partials.search')
@endsection

@section('content')

<div class="text-end mb-4">
    <a href="{{ route('products.create') }}" class="text-decoration-none color-dark-grey font-size-15">
        Додај нов продукт <img src="{{ asset('images/ic_round-plus.png') }}" alt="">
    </a>
</div>

@if(session('success'))
<div class="alert border border-success font-size-13 color-fancy-olive font-weight-500 p-2">
    {{ session('success') }}
</div>
@endif

<div class="view-container container-fluid p-0 m-0">
    <div class="list-container"></div>
    <div class="grid-container row">

    </div>
    <span class="loading">Loading...</span>
</div>

<div class="pagination-container d-flex justify-content-center pt-2">

</div>


<!-- <script>
    document.querySelectorAll('.delete-product').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productItem = this.closest('.product-item');

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
                    axios.delete(`/api/products/${productId}`)
                        .then(() => {
                            productItem.remove();
                            Swal.fire(
                                'Deleted!',
                                'The product has been deleted.',
                                'success'
                            );
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the product.',
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