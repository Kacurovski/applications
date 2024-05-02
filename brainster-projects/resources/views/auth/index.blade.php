@extends('layouts.app')

@section('content')
<div class="container p-0 w-100 center-vertical">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if ($errors->any() || session('error'))
            <div class="alert alert-danger mx-3">
                @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                @if(session('error'))
                {{ session('error') }}
                @endif
            </div>
            @endif
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="email" class="mb-3">Е-маил</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="mb-3">Пасворд</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div>
                    <button type="submit" class="btn btn-warning w-100">Логирај се</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection