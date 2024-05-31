<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // Menampilkan daftar rental untuk pengguna yang sedang login
    public function index()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $rentals = Rental::where('user_id', $userId)->with('car')->get(); // Mengambil semua rental milik pengguna yang sedang login beserta data mobilnya

        if (!$rentals) {
            return redirect()->route('cars.index')->with('error', 'Gagal memuat data rental.');
        }

        // Mengembalikan view dengan data rental
        return view('pages.rentals.index', compact('rentals'));
    }

    // Menyimpan rental baru ke dalam database
    public function store(Request $request)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        // Mengecek apakah pengguna memiliki rental yang sedang berjalan dengan status selain 'paid'
        $existingRental = Rental::where('user_id', $userId)
                                ->where('payment_status', '!=', 'success')
                                ->first();

        if ($existingRental) {
            return redirect()->route('cars.index')->with('error', 'Anda sudah memiliki rental yang sedang berjalan. Harap selesaikan pembayaran sebelum membuat rental baru.');
        }

        // Validasi data input
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rental_start_date' => 'required|date|after_or_equal:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
        ]);

        if (!$validated) {
            return redirect()->route('cars.index')->with('error', 'Data yang diinput tidak valid.');
        }

        $car = Car::find($request->car_id); // Mencari mobil berdasarkan ID

        if (!$car) {
            return redirect()->route('cars.index')->with('error', 'Mobil tidak ditemukan.');
        }

        // Mengecek ketersediaan mobil
        if (!$car->availability) {
            return redirect()->route('cars.index')->with('error', 'Mobil yang dipilih tidak tersedia.');
        }

        // Menghitung total hari sewa dan total biaya
        $totalDays = (new \DateTime($request->rental_end_date))->diff(new \DateTime($request->rental_start_date))->days;
        $totalCost = $totalDays * $car->rental_rate;

        // Membuat rental baru
        $rental = Rental::create([
            'user_id' => $userId,
            'car_id' => $request->car_id,
            'rental_start_date' => $request->rental_start_date,
            'rental_end_date' => $request->rental_end_date,
            'total_cost' => $totalCost,
            'payment_status' => 'unpaid',
        ]);

        if (!$rental) {
            return redirect()->route('cars.index')->with('error', 'Gagal membuat rental baru.');
        }

        // Mengupdate ketersediaan mobil
        $car->update(['availability' => false]);

        return redirect()->route('cars.index')->with('success', 'Permintaan rental berhasil diajukan.');
    }

    // Menampilkan detail rental berdasarkan ID
    public function show($id)
    {
        $rental = Rental::find($id); // Mencari rental berdasarkan ID

        if (!$rental) {
            return redirect()->route('rentals.index')->with('error', 'Gagal memuat detail rental.');
        }

        return view('pages.rentals.show', compact('rental')); // Mengembalikan view dengan data rental
    }


    // Menampilkan form edit rental berdasarkan ID
    public function edit($id)
    {
        $rental = Rental::find($id); // Mencari rental berdasarkan ID

        if (!$rental) {
            return redirect()->route('rentals.index')->with('error', 'Gagal memuat form edit rental.');
        }

        return view('pages.rentals.edit', compact('rental')); // Mengembalikan view dengan data rental
    }

    // Mengupdate data rental
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'rental_start_date' => 'required|date|after_or_equal:today',
            'rental_end_date' => 'required|date|after:rental_start_date',
        ]);

        if (!$validated) {
            return redirect()->route('rentals.index')->with('error', 'Data yang diinput tidak valid.');
        }

        $rental = Rental::find($id); // Mencari rental berdasarkan ID

        if (!$rental) {
            return redirect()->route('rentals.index')->with('error', 'Rental tidak ditemukan.');
        }

        // Menghitung total hari sewa dan total biaya
        $totalDays = (new \DateTime($request->rental_end_date))->diff(new \DateTime($request->rental_start_date))->days;
        $totalCost = $totalDays * $rental->car->rental_rate;

        // Mengupdate data rental
        $updated = $rental->update([
            'rental_start_date' => $request->rental_start_date,
            'rental_end_date' => $request->rental_end_date,
            'total_cost' => $totalCost,
        ]);

        if (!$updated) {
            return redirect()->route('rentals.index')->with('error', 'Gagal memperbarui tanggal rental.');
        }

        return redirect()->route('rentals.index')->with('success', 'Tanggal rental berhasil diperbarui.');
    }

    // Menghapus rental berdasarkan ID
    public function destroy($id)
    {
        $rental = Rental::find($id); // Mencari rental berdasarkan ID

        if (!$rental) {
            return redirect()->route('rentals.index')->with('error', 'Rental tidak ditemukan.');
        }

        $car = $rental->car; // Mengambil data mobil dari rental
        $deleted = $rental->delete(); // Menghapus rental

        if (!$deleted) {
            return redirect()->route('rentals.index')->with('error', 'Gagal menghapus rental.');
        }

        // Mengecek apakah mobil tidak memiliki rental lain dengan status unpaid sebelum mengupdate ketersediaannya
        if (!$car->rentals()->where('payment_status', 'unpaid')->exists()) {
            $car->update(['availability' => true]);
        }

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dihapus.');
    }
}
