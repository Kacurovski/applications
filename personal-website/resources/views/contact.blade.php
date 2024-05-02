@extends('layouts.master')

@section('title', 'contact')

@section('section-class', 'contact-section')

@section('page-title', 'Contact me')

@section('page-description', 'Have questions? I have answers!')

@section('content')
<div class="border-bottom">
    <div class="w-25 mx-auto py-5">
        <form>
            <div class="mb-3">
                <label for="name" class="form-label text-secondary m-0">Name</label>
                <input type="text" class="form-control form-control-underline" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-secondary m-0">Email Address</label>
                <input type="email" class="form-control form-control-underline" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label text-secondary m-0">Phone Number</label>
                <input type="number" class="form-control form-control-underline" id="phoneNumber" name="phoneNumber">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label text-secondary m-0">Message</label>
                <textarea name="message" class="form-control form-control-underline" id="message" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-info text-light">Send</button>
        </form>
    </div>
</div>
@endsection