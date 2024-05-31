@extends('layouts.app')

@section('title', 'My Rentals')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-6">My Rentals</h1>
    @if ($rentals->isEmpty())
        <p>You have no rentals.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rentals as $rental)
                <x-rental-card :rental="$rental" />
            @endforeach
        </div>
    @endif
</div>
@endsection
