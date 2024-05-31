<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Rental;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung total pengguna
        $totalUser = User::count();

        // Menghitung total mobil
        $totalCar = Car::count();

        // Menghitung total rental
        $totalRental = Rental::count();

        return view('pages.admin.dashboard', compact('totalUser', 'totalCar', 'totalRental'));
    }
}
