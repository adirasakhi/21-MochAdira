@props(['rental'])

@php
    use Carbon\Carbon;

    // Formatting tanggal
    $startDate = Carbon::parse($rental->rental_start_date)->locale('id')->translatedFormat('l, d F Y');
    $endDate = Carbon::parse($rental->rental_end_date)->locale('id')->translatedFormat('l, d F Y');
@endphp

<div class="card w-full max-w-sm bg-base-100 shadow-xl mx-auto">
    <figure class="px-10 pt-10">
        <img class="rounded-xl" src="{{ asset('storage/'.$rental->car->image) }}" alt="{{ $rental->car->model }}">
    </figure>
    <div class="card-body items-center text-center">
        <h2 class="card-title">{{ $rental->car->model }}</h2>
        <p class="text-gray-700">
            <span class="font-semibold block">Mulai Penyewaan Tanggal:</span>
            <span>{{ $startDate }}</span>
        </p>
        <p class="text-gray-700">
            <span class="font-semibold block">Akhir Penyewaan Tanggal:</span>
            <span>{{ $endDate }}</span>
        </p>
        <p class="text-gray-700">
            <span class="font-semibold block">Harga Rental /hari:</span>
            <span>Rp.{{ number_format($rental->car->rental_rate, 0, ',', '.') }},00</span>
        </p>
        <p class="text-gray-700">
            <span class="font-semibold block">Total Harga:</span>
            <span>Rp.{{ number_format($rental->total_cost, 0, ',', '.') }},00</span>
        </p>
        <p class="text-gray-700">
            <span class="font-semibold block">Status Pembayaran:</span>
            <span class="badge {{ in_array($rental->payment_status, ['paid', 'success']) ? 'badge-success' : 'badge-warning' }}">
                {{ ucfirst($rental->payment_status) }}
            </span>
        </p>
        <div class="card-actions justify-center">
            <a href="{{ route('rentals.show', $rental->id) }}" class="btn btn-info btn-circle">
                <i class="fas fa-info-circle"></i>
            </a>


            @if(!in_array($rental->payment_status, ['paid', 'success']))
            <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning btn-circle">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            @endif


            <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this rental?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error btn-circle">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</div>
