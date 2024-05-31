@extends('layouts.app')

@section('title', 'NotFound')
@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div data-aos="fade-in" class="text-center p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-6xl font-bold text-indigo-600 mb-4">404</h1>
        <p class="text-2xl font-semibold text-gray-700 mb-2">Page Not Found</p>
        <p class="text-gray-500 mb-6">The page you are looking for could not be found.</p>
        <a href="/" class="btn btn-primary text-white bg-indigo-600 px-4 py-2 rounded-md shadow-md hover:bg-indigo-500 transition duration-300">Go to Home</a>
    </div>
</div>
@endsection
