@extends('layouts.admin')
@section('title', 'RentalPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Rental Baru</h3>
                <p class="text-subtitle text-muted">Form untuk menambah rental baru</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rentals</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Rental Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rentals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach($users as $user)
                            @if ($user->role_id != 1) {{-- Exclude admin users --}}
                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="car_id">Car</label>
                    <select name="car_id" id="car_id" class="form-control">
                        @foreach($cars as $car)
                            @if ($car->availability) {{-- Only available cars --}}
                                <option value="{{ $car->id }}">{{ $car->model }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rental_start_date">Rental Start Date</label>
                    <input type="date" class="form-control" id="rental_start_date" name="rental_start_date" required>
                </div>
                <div class="form-group">
                    <label for="rental_end_date">Rental End Date</label>
                    <input type="date" class="form-control" id="rental_end_date" name="rental_end_date" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Rental</button>
            </form>
        </div>
    </div>
</section>
@endsection
