@extends('layouts.admin')
@section('title', 'UsersPageAdmin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Peminjam</h3>
                <p class="text-subtitle text-muted">Data Seluruh Peminjam</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Minimal jQuery Datatable start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Table Peminjam
            </h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">Tambah User Baru</a>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                @if ($user->role_id != 1) {{-- Exclude admin users --}}
                                    <tr>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->role->roles }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="px-2 pt-2 btn btn-success">
                                                        <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                                    </a>
                                                </div>
                                                <div class="me-2">
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                            <span class="select-all fa-fw fa-lg fas"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="me-2">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                                                        <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Minimal jQuery Datatable end -->
@endsection
