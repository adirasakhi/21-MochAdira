@extends('layouts.admin')
@section('title', 'RentalPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Rentals</h3>
                <p class="text-subtitle text-muted">Data Seluruh Rentals</p>
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
            <h5 class="card-title">
                Table Rentals
            </h5>
            <a href="{{ route('admin.rentals.create') }}" class="btn btn-primary mb-2">Tambah Rental Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Car</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Cost</th>
                            <th>Payment Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rentals as $rental)
                        <tr>
                            <td>{{ $rental->user->fullname }}</td>
                            <td>{{ $rental->car->model }}</td>
                            <td>{{ $rental->rental_start_date }}</td>
                            <td>{{ $rental->rental_end_date }}</td>
                            <td>{{ $rental->total_cost }}</td>
                            <td>{{ $rental->payment_status }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="me-2">
                                        @if($rental->payment_status == 'unpaid')
                                            <form action="{{ route('admin.rentals.approvePaid', $rental) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-check"></i> Approve Paid
                                                </button>
                                            </form>
                                        @elseif($rental->payment_status == 'paid')
                                            <form action="{{ route('admin.rentals.approveSuccess', $rental) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check"></i> Approve Success
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="me-2">
                                        <a href="{{ route('admin.rentals.show', $rental->id) }}" class="btn btn-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="me-2">
                                        <a href="{{ route('admin.rentals.edit', $rental->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="me-2">
                                        <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rental ini?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Tidak ada rentals.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
