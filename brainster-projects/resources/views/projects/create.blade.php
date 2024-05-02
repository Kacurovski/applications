@extends('layouts.app')

@section('content')

<div class="container p-0 mb-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="px-3">
                @if(session()->has('admin_id'))
                <div class="mb-3 px-1 mt-3">
                    <a href="{{ route('projects.create') }}" class="btn {{ request()->routeIs('projects.create') ? 'btn-success' : 'btn-secondary' }}">Додај</a>
                    <a href="{{ route('projects.editMode') }}" class="btn btn-secondary">Измени</a>
                </div>
                @endif
                <h1 class="h3 mb-4">Додај нов производ</h1>
            </div>
            <div class="container p-0">
                <div class="row">
                    <div class="col-10 offset-1">
                        @if (session('message'))
                        <div class="alert alert-success mx-3">{{ session('message') }}</div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger mx-3">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="px-3">
                            <form method="POST" action="{{ route('projects.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Име</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Поднаслов</label>
                                    <input type="text" name="subtitle" class="form-control" id="subtitle" aria-describedby="subtitleHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Слика</label>
                                    <input type="text" name="image" class="form-control" id="image" aria-describedby="imageHelp" placeholder="http://">
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input type="text" name="url" class="form-control" id="url" aria-describedby="url" placeholder="http://">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Oпис</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-warning w-100">Додај</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection