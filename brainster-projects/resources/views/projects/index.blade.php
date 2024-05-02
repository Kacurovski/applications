@extends('layouts.app')

@section('content')

@include('layouts.partials.header')

<div class="container p-0">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            @if(session()->has('admin_id'))
            <div class="mb-3 px-1">
                <a href="{{ route('projects.create') }}" class="btn btn-secondary">Додај</a>
                <a href="{{ route('projects.editMode') }}" class="btn btn-secondary">Измени</a>
            </div>
            @endif
            <div class="row">
                @foreach($projects as $project)
                <x-project-card :project="$project" />
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection