@extends('layouts.admin')
@section('title', 'DashboardPageAdmin')

@section('content')
<div class="page-heading mb-6">
    <h3 class="text-2xl font-bold">Admin Page</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card bg-purple-100">
                    <div class="card-body flex items-center p-6">
                        <div class="stats-icon bg-purple-500 text-white p-3 rounded-full mr-4">
                            <span class="fa-fw select-all fas fa-book"></span>
                        </div>
                        <div>
                            <h6 class="text-gray-500">Total Mobil</h6>
                            <h6 class="font-bold text-xl">{{ $totalCar }}</h6> <!-- Example value -->
                        </div>
                    </div>
                </div>
                <div class="card bg-blue-100">
                    <div class="card-body flex items-center p-6">
                        <div class="stats-icon bg-blue-500 text-white p-3 rounded-full mr-4">
                            <i class="iconly-boldProfile"></i>
                        </div>
                        <div>
                            <h6 class="text-gray-500">Total User</h6>
                            <h6 class="font-bold text-xl">{{ $totalUser }}</h6> <!-- Example value -->
                        </div>
                    </div>
                </div>
                <div class="card bg-red-100">
                    <div class="card-body flex items-center p-6">
                        <div class="stats-icon bg-red-500 text-white p-3 rounded-full mr-4">
                            <i class="iconly-boldBookmark"></i>
                        </div>
                        <div>
                            <h6 class="text-gray-500">Total Penyewaan</h6>
                            <h6 class="font-bold text-xl">{{ $totalRental }}</h6> <!-- Example value -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
