<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        // Mengambil semua data rental dan pengguna yang bukan admin
        $rentals = Rental::all();
        $users = User::where('role_id', '!=', 1)->get(); // Exclude admin users
        return view('pages.admin.rentals.index', compact('rentals','users'));
    }

    public function create()
    {
        // Mengambil data mobil yang availability true dan pengguna yang bukan admin
        $cars = Car::where('availability', true)->get();
        $users = User::where('role_id', '!=', 1)->get();
        return view('pages.admin.rentals.create', compact('cars', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi data request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'rental_start_date' => 'required|date|after_or_equal:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
        ]);

        // Memeriksa apakah pengguna sudah memiliki rental dengan status 'unpaid' atau 'paid'
        $existingRental = Rental::where('user_id', $request->user_id)
            ->whereIn('payment_status', ['unpaid', 'paid'])
            ->first();

        if ($existingRental) {
            return redirect()->route('admin.rentals.index')->with('error', 'User already has an existing rental with unpaid or paid status.');
        }

        // Menghitung total biaya rental
        $totalDays = (new \DateTime($request->rental_end_date))->diff(new \DateTime($request->rental_start_date))->days;
        $car = Car::findOrFail($request->car_id);
        $totalCost = $totalDays * $car->rental_rate;

        // Menyimpan data rental ke database
        Rental::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'rental_start_date' => $request->rental_start_date,
            'rental_end_date' => $request->rental_end_date,
            'total_cost' => $totalCost,
            'payment_status' => 'unpaid',
        ]);

        // Memperbarui ketersediaan mobil
        $car->update(['availability' => false]);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully.');
    }

    public function show($id)
    {
        // Menampilkan detail rental
        $rental = Rental::findOrFail($id);
        return view('pages.admin.rentals.show', compact('rental'));
    }

    public function edit($id)
    {
        // Menampilkan form edit rental dengan data rental, mobil yang availability true, dan pengguna yang bukan admin
        $rental = Rental::findOrFail($id);
        $cars = Car::where('availability', true)->get();
        $users = User::where('role_id', '!=', 1)->get();
        return view('pages.admin.rentals.edit', compact('rental','cars','users'));
    }

    public function update(Request $request, Rental $rental)
    {
        // Validasi data request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'rental_start_date' => 'required|date|after_or_equal:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
        ]);

        // Memeriksa apakah pengguna sudah memiliki rental dengan status 'unpaid' atau 'paid', kecuali rental saat ini
        $existingRental = Rental::where('user_id', $request->user_id)
            ->where('id', '!=', $rental->id)
            ->whereIn('payment_status', ['unpaid', 'paid'])
            ->first();

        if ($existingRental) {
            return redirect()->route('admin.rentals.index')->with('error', 'User already has an existing rental with unpaid or paid status.');
        }

        // Menghitung total biaya rental
        $totalDays = (new \DateTime($request->rental_end_date))->diff(new \DateTime($request->rental_start_date))->days;
        $totalCost = $totalDays * $rental->car->rental_rate;

        // Memperbarui data rental di database
        $rental->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'rental_start_date' => $request->rental_start_date,
            'rental_end_date' => $request->rental_end_date,
            'total_cost' => $totalCost,
        ]);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        // Mengambil data mobil terkait
        $car = $rental->car;

        // Menghapus data rental dari database
        $rental->delete();

        // Memeriksa apakah mobil tidak memiliki rental lain yang belum dibayar sebelum memperbarui ketersediaan mobil
        if (!$car->rentals()->where('payment_status', 'unpaid')->exists()) {
            $car->update(['availability' => true]);
        }

        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully.');
    }

    public function approvePaid(Rental $rental)
    {
        // Memeriksa status pembayaran rental dan memperbaruinya jika statusnya 'unpaid'
        if ($rental->payment_status == 'unpaid') {
            $rental->update(['payment_status' => 'paid']);
            return redirect()->route('admin.rentals.index')->with('success', 'Rental payment approved and marked as paid.');
        }

        return redirect()->route('admin.rentals.index')->with('error', 'Rental payment status is not unpaid.');
    }

    public function approveSuccess(Rental $rental)
    {
        // Memeriksa status pembayaran rental dan memperbaruinya jika statusnya 'paid'
        if ($rental->payment_status == 'paid') {
            $rental->update(['payment_status' => 'success']);
            $car = $rental->car;
            // Memperbarui ketersediaan mobil
            $car->update(['availability' => true]);
            return redirect()->route('admin.rentals.index')->with('success', 'Rental marked as success and car availability updated.');
        }

        return redirect()->route('admin.rentals.index')->with('error', 'Rental payment status is not paid.');
    }
}
