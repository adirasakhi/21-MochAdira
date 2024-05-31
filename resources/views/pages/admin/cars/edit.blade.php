@extends('layouts.admin')
@section('title', 'CarsPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ isset($car) ? 'Edit Mobil' : 'Tambah Mobil' }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.cars.index') }}">Cars</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ isset($car) ? 'Edit' : 'Tambah' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($car) ? route('admin.cars.update', $car->slug) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($car))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" placeholder="Isi dengan Brand Mobil| ex.fortuner" id="brand" name="brand" value="{{ old('brand', $car->brand ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" placeholder="Isi dengan nama Model Mobil| ex.Fortuner" id="model" name="model" value="{{ old('model', $car->model ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="rental_rate">Rental Rate</label>
                    <input type="number" class="form-control" placeholder="Isi dengan rate Harga| ex.120000" id="rental_rate" name="rental_rate" value="{{ old('rental_rate', $car->rental_rate ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select class="form-control" id="availability" name="availability" required>
                        <option value="1" {{ old('availability', $car->availability ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('availability', $car->availability ?? '') == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" placeholder="Isi dengan Deskripsi mobil| ex.Mobil ini Adalah keluaran terbaru" id="description" name="description">{{ old('description', $car->description ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="advantages">Advantages (comma separated)</label>
                    <input type="text" class="form-control" placeholder="Isi dengan Brand Mobil| ex.Konsumsi BBM Efisien, Audio Sistem, Ruang Luas, Kursi Nyaman" id="advantages" name="advantages" value="{{ old('advantages', isset($car) ? implode(', ', $car->advantages) : '') }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($car) ? 'Update' : 'Create' }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
