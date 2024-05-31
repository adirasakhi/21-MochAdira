@extends('layouts.app')

@section('title', 'Daftar Mobil')

@section('content')
<div class="carousel w-full rounded mb-5" id="carousel">
    <div id="slide1" class="carousel-item relative w-full">
      <img src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
      </div>
    </div>
    <div id="slide2" class="carousel-item relative w-full">
      <img src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
      </div>
    </div>
    <div id="slide3" class="carousel-item relative w-full">
      <img src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
      </div>
    </div>
    <div id="slide4" class="carousel-item relative w-full">
      <img src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
      </div>
    </div>
</div>
<main class="px-8 mx-auto mt-20 lg:px-[100px]">
    <h1 class="text-3xl font-bold mb-6">Daftar Mobil</h1>
    <div class="p-5 flex justify-end items-center space-x-4">
        <form id="filterForm" method="POST" action="{{ route('cars.index') }}">
            @csrf
            <label for="filterBy" class="mr-4">Filter by:</label>
            <select id="filterBy" name="sort" class="select select-bordered w-full max-w-xs" onchange="document.getElementById('filterForm').submit();">
                <option disabled selected>Filter by</option>
                <option value="high-to-low" {{ $sort == 'high-to-low' ? 'selected' : '' }}>Harga Tertinggi ke Terendah</option>
                <option value="low-to-high" {{ $sort == 'low-to-high' ? 'selected' : '' }}>Harga Terendah ke Tertinggi</option>
            </select>
        </form>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach ($cars as $car)
            <x-car-card :car="$car" />
        @endforeach
    </div>
    <div class="mt-8">
        {{ $cars->links() }}
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.carousel-item');
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, idx) => {
                slide.classList.toggle('hidden', idx !== index);
                slide.classList.toggle('block', idx === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto play every 2 seconds
        setInterval(nextSlide, 10000);

        // Initialize the first slide
        showSlide(currentSlide);
    });
</script>
@endsection
