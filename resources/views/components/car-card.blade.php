@props(['car'])

@php
    $description = Str::words($car->description, 10, '...');
@endphp

<div class="bg-base-100 shadow-xl rounded-lg flex flex-col justify-between h-full">
    <div class="p-6 flex-1">
        <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->model }}" class="w-full h-[200px] object-cover rounded-t-lg mb-4">
        <h2 class="text-xl font-bold mb-2">{{ $car->model }}</h2>
        <h3 class="text-l mb-2">Ketersediaan: {{ $car->availability ? 'Tersedia' : 'Tidak Tersedia' }}</h3>
        <h3 class="text-l mb-2">Brand: {{ $car->brand }}</h3>
        <h3 class="text-l mb-2">Harga Sewa/hari: Rp.{{ number_format($car->rental_rate, 0, ',', '.') }},00</h3>
        <p class="text-gray-700 mb-4">{{ $description }}</p>
    </div>
    <div class="p-6">
        <a href="{{ route('cars.show', $car->slug) }}" class="btn btn-primary w-full">Detail</a>
    </div>
</div>
