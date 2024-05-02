@extends('layouts.app')
@section('content')

<div class="container px-4">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            @if(session()->has('admin_id'))
            <div class="mb-3 px-1 mt-3">
                    <a href="{{ route('projects.create') }}" class="btn {{ request()->routeIs('projects.create') ? 'btn-success' : 'btn-secondary' }}">Додај</a>
                    <a href="{{ route('projects.editMode') }}" class="btn {{ request()->routeIs('projects.editMode') ? 'btn-success' : 'btn-secondary' }}">Измени</a>
                </div>
            @endif
            <p class="h3 px-1 mb-4">Измени постоечки производи</p>
            @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
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

<script src="{{asset('js/functions/edit_mode.js')}}" defer></script>