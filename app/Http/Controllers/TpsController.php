<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location; // Pastikan model Location sudah dibuat
use App\Models\Tps; // Pastikan model Tps sudah dibuat
use Illuminate\Support\Str;

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
        'jam_buka'         => 'nullable|date_format:H:i',
        'jam_tutup'        => 'nullable|date_format:H:i|after:jam_buka',
        'kapasitas_tps'    => 'nullable|integer|min:0',
        'fasilitas'        => 'nullable|string',
        'foto_lokasi'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'ulasan'           => 'nullable|string',
    ]);

    // Gabungkan jam buka dan tutup menjadi satu string
    $validated['jam_operasional'] = $validated['jam_buka'] && $validated['jam_tutup']
        ? $validated['jam_buka'] . ' - ' . $validated['jam_tutup']
        : null;

    // Hapus jam_buka dan jam_tutup agar tidak masuk ke mass assignment
    unset($validated['jam_buka'], $validated['jam_tutup']);

    // Cari TPS berdasarkan ID
    $tps = Tps::findOrFail($id);

    // Jika ada file gambar, simpan dan update path-nya


if ($request->hasFile('foto_lokasi')) {
    $file = $request->file('foto_lokasi');
    $filename = time() . '_' . $file->getClientOriginalName();
    $fotoPath = $file->storeAs('tps_images', $filename, 'public');
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
