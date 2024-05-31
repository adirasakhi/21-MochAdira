@extends('layouts.admin')
@section('title', 'RentalPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Rental</h3>
                <p class="text-subtitle text-muted">Informasi detail rental</p>
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
            <h5 class="card-title">Detail Rental</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>User</th>
                    <td>{{ $rental->user->fullname }}</td>
                </tr>
                <tr>
                    <th>Car</th>
                    <td>{{ $rental->car->model }}</td>
                </tr>
                <tr>
                    <th>Rental Start Date</th>
                    <td>{{ $rental->rental_start_date }}</td>
                </tr>
                <tr>
                    <th>Rental End Date</th>
                    <td>{{ $rental->rental_end_date }}</td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{ $rental->total_cost }}</td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td>{{ $rental->payment_status }}</td>
                </tr>
            </table>
            <a href="{{ route('admin.rentals.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</section>
@endsection
