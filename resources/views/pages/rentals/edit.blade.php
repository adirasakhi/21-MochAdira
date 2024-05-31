@extends('layouts.app')

@section('title', 'Edit Rental')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Rental</h1>
    <form action="{{ route('rentals.update', $rental->id) }}" method="POST" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="rental_start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            <input type="date" id="rental_start_date" name="rental_start_date" value="{{ $rental->rental_start_date }}" class="form-input mt-1 block w-full">
        </div>
        <div class="mb-4">
            <label for="rental_end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            <input type="date" id="rental_end_date" name="rental_end_date" value="{{ $rental->rental_end_date }}" class="form-input mt-1 block w-full">
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="btn btn-primary">Update Rental</button>
        </div>
    </form>
</div>
@endsection
