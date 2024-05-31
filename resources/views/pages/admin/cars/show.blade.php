@extends('layouts.admin')
@section('title', 'CarsPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Mobil</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.cars.index') }}">Cars</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h4>{{ $car->brand }} - {{ $car->model }}</h4>
            <p><strong>Rate:</strong> ${{ $car->rental_rate }}</p>
            <p><strong>Available:</strong> {{ $car->availability ? 'Yes' : 'No' }}</p>
            <p><strong>Description:</strong> {{ $car->description }}</p>
            <p><strong>Image:</strong> <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->model }}" style="max-width: 100px;"></p>
            <p><strong>Advantages:</strong> {{ implode(', ', $car->advantages) }}</p>
            <a href="{{ route('admin.cars.index') }}" class="btn btn-primary">Back to List</a>
            <a href="{{ route('admin.cars.edit', $car->slug) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.cars.destroy', $car->slug) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">Delete</button>
            </form>
        </div>
    </div>
</section>
@endsection
