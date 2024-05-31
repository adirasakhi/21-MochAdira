@extends('layouts.admin')
@section('title', 'CarsPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Mobil</h3>
                <p class="text-subtitle text-muted">Data Seluruh Mobil</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cars</li>
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
                Table Mobil
            </h5>
            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-2">Tambah Mobil Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table2">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Rate</th>
                            <th>Available</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cars as $car)
                        <tr>
                            <td>
                                @if ($car->image)
                                    <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->model }}" style="max-width: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->rental_rate }}</td>
                            <td>{{ $car->availability ? 'Yes' : 'No' }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <a href="{{ route('admin.cars.show', $car->slug) }}" class="btn btn-success">
                                            <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                        </a>
                                    </div>
                                    <div class="me-2">
                                        <a href="{{ route('admin.cars.edit', $car->slug) }}" class="btn btn-warning">
                                            <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                        </a>
                                    </div>
                                    <div class="me-2">
                                        <form action="{{ route('admin.cars.destroy', $car->slug) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                                <span class="select-all fa-fw fa-lg fas"></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada mobil.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
