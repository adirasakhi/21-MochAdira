<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        // mengambil data Car
        $cars = Car::all();
        return view('pages.admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('pages.admin.cars.create');
    }

    public function store(Request $request)
    {
        // validasi Data
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rental_rate' => 'required|numeric',
            'availability' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'advantages' => 'nullable|string',
        ]);

        // menyimpan gambar Mobil
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        // penulisan Data untuk Advantages
        $data['advantages'] = $request->input('advantages', '');

        //menyimpan Data ke Database
        Car::create($data);

        // redirect ke Page car Admin
        return redirect()->route('admin.cars.index')->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        return view('pages.admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('pages.admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validasi Data
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'rental_rate' => 'required|numeric',
            'availability' => 'required|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'advantages' => 'nullable|string',
        ]);

        // Memeriksa dan menyimpan gambar Mobil baru
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }

            // Menyimpan gambar baru
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        // Penulisan Data untuk Advantages
        $data['advantages'] = $request->input('advantages', '');

        // Memperbarui Data di Database
        $car->update($data);

        // Redirect ke halaman index mobil admin dengan pesan sukses
        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        // Menghapus gambar Mobil jika ada
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        // Menghapus Data dari Database
        $car->delete();

        // Redirect ke halaman index mobil admin dengan pesan sukses
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}
