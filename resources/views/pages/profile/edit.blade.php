@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label class="block text-gray-700">Full Name</label>
                    <input type="text" name="fullname" value="{{ $user->fullname }}" class="input input-bordered w-full">
                </div>
                <div class="col-span-1" hidden>
                    <label class="block text-gray-700">Role</label>
                    <input type="text" name="role_id" value="{{ $user->role_id }}" class="input input-bordered w-full">
                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700">NIK</label>
                    <input type="text" name="nik" value="{{ $user->nik }}" class="input input-bordered w-full">
                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="input input-bordered w-full">
                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700">Address</label>
                    <input type="text" name="address" value="{{ $user->address }}" class="input input-bordered w-full">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
