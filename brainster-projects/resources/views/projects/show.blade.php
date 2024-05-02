@extends('layouts.app')


@section('content')

<div class="container show-project-container d-flex justify-content-center my-5 p-0">
        <x-project-card :project="$project" />
</div>
@endsection