@extends('layouts.admin')
@section('title', 'UsersPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Tambah User Baru</h3>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Isi Dengan Nama Lengkap | ex.Udin" id="fullname" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->roles }}</option>
                        @endforeach
                    </select>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" placeholder="Isi Dengan No Nik | ex.1234567812345678" id="nik" name="nik" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Isi Dengan email | udin@gmail.com" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" placeholder="Isi Dengan Alamat | ex.jl.otisata" id="address" name="address">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Isi Dengan password | " id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Isi Dengan password |" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</section>
@endsection
