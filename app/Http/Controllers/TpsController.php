<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location; // Pastikan model Location sudah dibuat
use App\Models\Tps; // Pastikan model Tps sudah dibuat

class TpsController extends Controller
{
    public function index()
    {
        // Mengambil semua data TPS dari model Tps
        $tps = Tps::all();

        // Mengembalikan view dengan data TPS
        return view('tps.index', compact('tps'));
    }

    public function edit($id)
{
    $tps = Tps::with('location')->findOrFail($id); // Tambahkan with()

    return view('tps.edit', compact('tps', ));
}
public function update(Request $request, $id)
{
    // Validasi input untuk tabel TPS
    $validated = $request->validate([
        'jumlah_pekerja'   => 'nullable|integer|min:0',
        'luas'             => 'nullable|numeric|min:0',
        'jam_operasional'  => 'nullable|string|max:255',
        'kapasitas_tps'    => 'nullable|integer|min:0',
        'fasilitas'        => 'nullable|string',
        'foto_lokasi'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'ulasan'           => 'nullable|string',
    ]);


    // Cari TPS berdasarkan ID
    $tps = Tps::findOrFail($id);

    // Jika ada file gambar, simpan dan update path-nya
    if ($request->hasFile('foto_lokasi')) {
        $fotoPath = $request->file('foto_lokasi')->store('tps_images', 'public');
        $validated['foto_lokasi'] = $fotoPath;
    }

    // Update data TPS
    $tps->update($validated);

    return redirect()->route('tps.index')->with('success', 'Data TPS berhasil diperbarui.');
}

    public function destroy($id)
    {
        // Mencari TPS berdasarkan ID
        $tps = Tps::findOrFail($id);

        // Menghapus TPS
        $tps->delete();

        // Redirect atau mengembalikan response sesuai kebutuhan
        return redirect()->route('tps.index')->with('success', 'TPS berhasil dihapus');
    }
}
