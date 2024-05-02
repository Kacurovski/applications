@extends('layouts.master')

@section('title', 'home')

@section('section-class', 'home-section')

@section('page-title', 'Clean Blog')

@section('page-description', 'A Blog Theme By Start Bootstrap')

@section('content')
<div class="border-bottom">
    <div class="w-25 mx-auto py-5">
        <div class="border-bottom mb-3 pb-4">
            <h2 class="fw-bold">Lorem Ipsum</h2>
            <p class="h5 fw-400 m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum quis, eveniet autem eos nulla eum.</p>
            <small class="text-secondary fst-italic">Posted by <span class="fw-bold">John Doe</span></small>
        </div>
        <div class="border-bottom mb-3 pb-4">
            <h2 class="fw-bold">Lorem Ipsum 2</h2>
            <small class="text-secondary fst-italic">Posted by <span class="fw-bold">John Doe </span>in another boring news</small>
        </div>
        <div class="border-bottom mb-3 pb-4">
            <h2 class="fw-bold">Lorem Ipsum 3</h2>
            <p class="h5 fw-400 m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae corporis voluptate laboriosam officia amet a hic molestiae quaerat veniam nisi quasi sed rerum quibusdam quas, vel aperiam, eos inventore dignissimos laudantium ipsum ipsa! Dolorem consequatur, cum vel architecto eveniet provident!</p>
            <small class="text-secondary fst-italic">Posted by <span class="fw-bold">John Doe</span></small>
        </div>
        <div class="border-bottom mb-3 pb-4">
            <h2 class="fw-bold">Lorem Ipsum 4</h2>
            <p class="h5 fw-400 m-0">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            <small class="text-secondary fst-italic">Posted by <span class="fw-bold">Missy Doe</span></small>
        </div>
        <div class="text-end">
            <button class="btn btn-info text-light">Older Posts-></button>
        </div>
    </div>
</div>
@endsection