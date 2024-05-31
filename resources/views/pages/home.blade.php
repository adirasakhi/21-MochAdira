@extends('layouts.app')

@section('title', 'Detail Mobil')

@section('content')

    <section class="welcome-section mt-32" data-aos="fade-down">
        <div class="welcome-text-left">
            <h1 class="text-4xl font-bold text-dodger-blue">Selamat Datang di CarXRent</h1>
            <p class="mt-4 text-lg text-gray-700">Solusi terbaik untuk penyewaan mobil Anda.</p>
        </div>
        <div class="welcome-image-right">
            <img src="{{ asset('asset/images/gedung.jpg') }}" alt="Foto Pemilik" class="rounded-lg" data-aos="fade-left">
        </div>
    </section>

    <section id="about-us" class="mt-20" data-aos="fade-down">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-dodger-blue">🤔 Siapa Kami?</h2>
            <p class="mt-4 text-gray-700">CarXRent adalah perusahaan penyedia layanan rental mobil terpercaya dengan pengalaman lebih dari 10 tahun.</p>
            <p class="mt-2 text-gray-700">Kami menyediakan berbagai jenis mobil dengan harga terjangkau dan layanan pelanggan yang prima.</p>
        </div>
    </section>

    <section id="car-services" class="flex flex-wrap justify-center mt-10" data-aos="fade-down">
        <div class="w-full text-center mb-8">
            <h2 class="text-2xl font-bold text-dodger-blue">💪 Keunggulan Kami 🔥</h2>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/3">
            <div class="p-6 bg-white rounded-lg shadow-lg text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('asset/images/mobil.jpg') }}" alt="Mobil Terbaik" class="rounded-lg keunggulan" data-aos="fade-left">
                </div>
                <h3 class="text-xl font-bold text-dodger-blue">🚘 Mobil Terbaik</h3>
                <p class="mt-4 text-gray-700">Kami menyediakan berbagai macam mobil dengan kualitas terbaik untuk kebutuhan Anda.</p>
            </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/3">
            <div class="p-6 bg-white rounded-lg shadow-lg text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('asset/images/harga.png') }}" alt="Harga Terjangkau" class="rounded-lg keunggulan" data-aos="fade-left">
                </div>
                <h3 class="text-xl font-bold text-dodger-blue">🤑 Harga Terjangkau</h3>
                <p class="mt-4 text-gray-700">Dapatkan harga terbaik dengan berbagai promo menarik untuk setiap penyewaan mobil.</p>
            </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/3">
            <div class="p-6 bg-white rounded-lg shadow-lg text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('asset/images/pelayanan.jpg') }}" alt="Layanan Terpercaya" class="rounded-lg keunggulan" data-aos="fade-left">
                </div>
                <h3 class="text-xl font-bold text-dodger-blue">💁🏻 Layanan Terpercaya</h3>
                <p class="mt-4 text-gray-700">Kami memberikan layanan terbaik dengan dukungan pelanggan yang siap membantu Anda 24/7.</p>
            </div>
        </div>
    </section>

    <section id="google-maps" class="mt-20 mx-auto text-center" data-aos="fade-down">
        <div>
            <h2 class="text-2xl font-bold text-dodger-blue mb-3">🗺️ Lokasi Kami</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.254103393832!2d107.90452367499925!3d-7.211827192793855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1359322200f%3A0xab3d24d1da96e2a!2sGarut%20Plaza!5e0!3m2!1sid!2sid!4v1716133222919!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section id="owner-profile" class="flex flex-wrap justify-center mt-10" data-aos="fade-down">
        <div class="w-full p-4 md:w-1/2 lg:w-2/3">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('asset/images/owner.jpeg') }}" alt="Foto Pemilik" class="w-[150px] h-[150px] rounded-lg" data-aos="fade-left">
                </div>
                <h2 class="text-2xl font-bold text-dodger-blue text-center">👨‍💼 Owner</h2>
                <p class="mt-4 text-gray-700 text-center">Nama: John Doe</p>
                <p class="mt-2 text-gray-700 text-center">Umur: 40 tahun</p>
                <p class="mt-2 text-gray-700 text-center">Pengalaman: 15 tahun di industri rental mobil.</p>
            </div>
        </div>
    </section>

@endsection
