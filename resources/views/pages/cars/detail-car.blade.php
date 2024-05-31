@extends('layouts.app')

@section('title', 'Detail Mobil')

@section('content')
<main class="px-8 mx-auto mt-20 lg:px-[100px]">
    <h1 class="text-3xl font-bold mb-6">Detail Mobil</h1>
    <div class="bg-base-100 shadow-xl rounded-lg p-6">
        <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->model }}" class="w-full h-[400px] object-cover rounded-t-lg">
        <h2 class="text-2xl font-bold mb-2">{{ $car->model }}</h2>
        <h3 class="text-l mb-2">Ketersediaan: {{ $car->availability }}</h3>
        <h3 class="text-l mb-2">Warna Mobil: {{ $car->color }}</h3>
        <h3 class="text-l mb-2">Harga Sewa/hari: Rp.{{ number_format($car->rental_rate, 0, ',', '.') }},00</h3>
        <p class="text-gray-700 mb-4">{{ $car->description ?? 'Deskripsi tidak tersedia' }}</p>
        <ul class="list-disc pl-5 mb-4">
            @foreach ($car->advantages as $advantage)
                <li>{{ $advantage }}</li>
            @endforeach
        </ul>
        @if (auth()->user()->role_id == 1)
            <button class="btn btn-secondary mt-4" disabled>Admin tidak bisa meminjam</button>
        @else
            <button class="btn btn-primary mt-4" onclick="openModal('rent{{ $car->model }}-{{ $car->id }}')">Sewa Sekarang</button>
        @endif
    </div>
</main>

<!-- Modal 1 -->
<div id="rent{{ $car->model }}-{{ $car->id }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Tata Cara Peminjaman</h3>
        <p class="py-4">
            1. Baca dengan seksama syarat dan ketentuan.<br>
                *Pengguna hanya boleh meminjam jika Penyewaan Sebelumnya Selesai,<br>
                *Untuk penyelesaian Penyewaan akan di selesaikan Oleh admin jika seluruh ketentuan terpenuhi;<br>
            2. Isi formulir peminjaman dengan lengkap.<br>
            3. Serahkan dokumen yang diperlukan.<br>
                *KTP,<br>
                *Uang Untuk penyelesaian Pembayaran;<br>
            4. Pastikan mobil dalam kondisi baik saat pengambilan dan pengembalian.<br>
            5. Hubungi layanan pelanggan jika ada masalah.<br>
        </p>
        <div class="form-control">
            <label class="label cursor-pointer">
                <input type="checkbox" id="agree-checkbox-{{ $car->id }}" onchange="toggleButton('agree-checkbox-{{ $car->id }}', 'next-button-{{ $car->id }}')" class="checkbox">
                <span class="label-text"> Saya telah membaca dan menyetujui tata cara peminjaman.</span>
            </label>
        </div>
        <div class="modal-action">
            <button class="btn btn-primary" id="next-button-{{ $car->id }}" disabled onclick="openModal('rent-form{{ $car->model }}-{{ $car->id }}')">Lanjutkan</button>
            <button class="btn" onclick="closeModal('rent{{ $car->model }}-{{ $car->id }}')">Batal</button>
        </div>
    </div>
</div>

<!-- Modal 2 -->
<div id="rent-form{{ $car->model }}-{{ $car->id }}" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Formulir Peminjaman</h3>
        <form id="rental-form-{{ $car->id }}" method="POST" action="{{ route('apply-rent') }}">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" name="fullname" value="{{ $user->fullname ?? '' }}" placeholder="Nama Anda" class="input input-bordered">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}" placeholder="Email Anda" class="input input-bordered">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Tanggal Mulai Rental</span>
                </label>
                <input type="text" id="rental-date-{{ $car->id }}" name="rental_start_date" placeholder="Pilih Tanggal" class="input input-bordered">
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Tanggal Akhir Rental</span>
                </label>
                <input type="text" id="rental-date-end-{{ $car->id }}" name="rental_end_date" placeholder="Pilih Tanggal" class="input input-bordered">
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                <button type="button" class="btn" onclick="closeModal('rent-form{{ $car->model }}-{{ $car->id }}')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function toggleButton(checkboxId, buttonId) {
        const checkbox = document.getElementById(checkboxId);
        const button = document.getElementById(buttonId);

        if (checkbox.checked) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    }

    function openModal(modalId) {
        document.getElementById(modalId).classList.add('modal-open');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('modal-open');
    }

    // Initialize flatpickr on the date input fields
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#rental-date-{{ $car->id }}", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });
        flatpickr("#rental-date-end-{{ $car->id }}", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    });
</script>
@endsection
