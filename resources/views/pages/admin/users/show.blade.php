@extends('layouts.admin')
@section('title', 'UsersPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Detail User</h3>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Nama Lengkap: {{ $user->fullname }}</h5>
            <p>Email: {{ $user->email }}</p>
            <p>Alamat: {{ $user->address }}</p>
            <p>Role: {{ $user->role_id }}</p>
            <p>NIK: {{ $user->nik }}</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>
@endsection
