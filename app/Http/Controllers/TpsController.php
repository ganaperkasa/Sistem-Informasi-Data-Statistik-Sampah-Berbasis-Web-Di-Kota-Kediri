<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Tps;
use App\Models\WasteEntry;
use App\Models\WasteOutflow;
use App\Models\ReduksiSampah;

use Illuminate\Support\Str;

class TpsController extends Controller
{
    public function index()
    {
        // Mengambil semua data TPS dari model Tps
        $tps = Tps::with('location')->paginate(10);

        // Mengembalikan view dengan data TPS
        return view('tps.index', compact('tps'));
    }

    public function edit($id)
    {
        $tps = Tps::with('location')->findOrFail($id); // Tambahkan with()

        return view('tps.edit', compact('tps'));
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'jumlah_pekerja' => 'nullable|integer|min:0',
                'luas' => 'nullable|numeric|min:0',
                'jam_buka' => 'nullable|date_format:H:i',
                'jam_tutup' => 'nullable|date_format:H:i|after:jam_buka',
                'kapasitas_tps' => 'nullable|integer|min:0',
                'fasilitas' => 'nullable|string',
                'foto_lokasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'ulasan' => 'nullable|string',
            ],
            [
                'foto_lokasi.max' => 'Ukuran foto lokasi tidak boleh lebih dari 2MB.',
                'foto_lokasi.image' => 'File yang diunggah harus berupa gambar.',
                'foto_lokasi.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
                'jam_tutup.after' => 'Jam tutup harus lebih besar dari jam buka.',
            ],
        );

        $validated['jam_operasional'] = $validated['jam_buka'] && $validated['jam_tutup'] ? $validated['jam_buka'] . ' - ' . $validated['jam_tutup'] : null;

        unset($validated['jam_buka'], $validated['jam_tutup']);

        $tps = Tps::findOrFail($id);

        if ($request->hasFile('foto_lokasi')) {
            $file = $request->file('foto_lokasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $fotoPath = $file->storeAs('tps_images', $filename, 'public');
            $validated['foto_lokasi'] = $fotoPath;
        }

        $tps->update($validated);

        return redirect()->route('tps.index')->with('success', 'Data TPS berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tps = Tps::findOrFail($id);
        $location = $tps->location;

        Tps::where('locations_id', $location->id)->delete();
        WasteEntry::where('location_id', $location->id)->delete();
        WasteOutflow::where('location_id', $location->id)->delete();
        ReduksiSampah::where('location_id', $location->id)->delete();

        $location->delete();

        return redirect()->back()->with('success', 'Data lokasi dan semua relasinya berhasil dihapus.');
    }
}
