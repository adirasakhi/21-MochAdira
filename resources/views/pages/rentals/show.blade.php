@extends('layouts.app')

@section('title', 'Rental Details')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-6 text-center">Rental Details</h1>
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <figure class="px-10 pt-10">
            <img class="rounded-xl w-full" src="{{ asset('storage/'.$car->image) }}" alt="{{ $rental->car->model }}">
        </figure>
        <div class="p-6 text-center">
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Id Pesanan:</h2>
                <p class="text-gray-700">{{ $rental->id }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Model Mobil:</h2>
                <p class="text-gray-700">{{ $rental->car->model }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Nama Perental:</h2>
                <p class="text-gray-700">{{ $rental->user->fullname }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Mulai Penyewaan Tanggal:</h2>
                <p class="text-gray-700">{{ Carbon\Carbon::parse($rental->rental_start_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Akhir Penyewaan Tanggal:</h2>
                <p class="text-gray-700">{{ Carbon\Carbon::parse($rental->rental_end_date)->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Total Harga:</h2>
                <p class="text-gray-700">Rp.{{ number_format($rental->total_cost, 0, ',', '.') }},00</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Status Pembayaran:</h2>
                <p class="text-gray-700">
                    <span class="badge {{ $rental->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                        {{ ucfirst($rental->payment_status) }}
                    </span>
                </p>
            </div>
            <div class="mt-6">
                <a href="{{ route('rentals.index') }}" class="btn btn-primary">Back to Rentals</a>
            </div>
        </div>
    </div>
</div>
@endsection
