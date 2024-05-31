<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // Menampilkan daftar mobil yang tersedia dengan opsi sorting
    public function index(Request $request)
    {
        // Validasi parameter sort dari input
        $request->validate([
            'sort' => 'in:high-to-low,low-to-high,asc'
        ]);

        // Mengambil nilai sort dari input, default adalah 'asc' (ascending)
        $sort = $request->input('sort', 'asc');

        // Membuat query untuk mengambil mobil yang tersedia
        $query = Car::where('availability', true);

        // Menentukan urutan berdasarkan nilai sort
        switch ($sort) {
            case 'high-to-low':
                $query->orderBy('rental_rate', 'desc'); // Urutan dari harga tertinggi ke terendah
                break;
            case 'low-to-high':
                $query->orderBy('rental_rate', 'asc'); // Urutan dari harga terendah ke tertinggi
                break;
            // Jika sort adalah 'asc' atau nilai default
            default:
                $query->orderBy('id', 'asc'); // Urutan berdasarkan id secara ascending
                break;
        }

        // Mengambil data mobil dengan pagination, 6 mobil per halaman
        $cars = $query->paginate(6);

        // Mengembalikan view halaman daftar mobil dengan data mobil dan nilai sort
        return view('pages.cars.index', compact('cars', 'sort'));
    }

    // Menampilkan detail mobil berdasarkan slug
    public function show($slug)
    {
        // Mencari mobil berdasarkan slug
        $car = Car::where('slug', $slug)->firstOrFail();

        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        // Mengembalikan view detail mobil dengan data mobil dan pengguna
        return view('pages.cars.detail-car', compact('car', 'user'));
    }
}
