@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Profile</h2>
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-pencil-alt"></i> Edit Profile
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="col-span-1">
                <label class="block text-gray-700">Full Name</label>
                <p class="bg-gray-100 p-2 rounded-md">{{ $user->fullname }}</p>
            </div>
            <div class="col-span-1">
                <label class="block text-gray-700">NIK</label>
                <p class="bg-gray-100 p-2 rounded-md">{{ $user->nik }}</p>
            </div>
            <div class="col-span-1">
                <label class="block text-gray-700">Email</label>
                <p class="bg-gray-100 p-2 rounded-md">{{ $user->email }}</p>
            </div>
            <div class="col-span-1">
                <label class="block text-gray-700">Address</label>
                <p class="bg-gray-100 p-2 rounded-md">{{ $user->address }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
