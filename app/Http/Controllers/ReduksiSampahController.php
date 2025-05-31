<?php

namespace App\Http\Controllers;

use App\Models\ReduksiSampah;
use App\Models\WasteEntry;
use App\Models\WasteOutflow;
use App\Models\Location;
use Illuminate\Http\Request;

class ReduksiSampahController extends Controller
{
    public function index()
{
    $reduksiSampah = ReduksiSampah::with('location')->orderBy('reduction_date', 'desc')->get();
    return view('reduksi-sampah.index', compact('reduksiSampah'));
}

    public function create()
    {
        $locations = Location::all();
        return view('reduksi-sampah.create', compact('locations'));
    }
    public function hitungDanSimpan(Request $request)
    {
        $locationId = $request->location_id;
        $tanggal = $request->tanggal ?? now()->toDateString();

        $masuk = WasteEntry::where('location_id', $locationId)
            ->where('entry_date', $tanggal)
            ->sum('amount_kg');

        $keluar = WasteOutflow::where('location_id', $locationId)
            ->where('outflow_date', $tanggal)
            ->sum('amount_kg');

        $reduksi = $keluar;
        $persentase = ($masuk > 0) ? ($keluar / $masuk) * 100 : 0;

        ReduksiSampah::updateOrCreate(
            ['location_id' => $locationId, 'reduction_date' => $tanggal],
            [
                'sampah_masuk' => $masuk,
                'sampah_keluar' => $keluar,
                'reduksi_kg' => $reduksi,
                'persentase_reduksi' => round($persentase, 2),
            ]
        );

        return redirect()->route('reduksi_sampah.index')->with('success', 'Data reduksi sampah berhasil disimpan.');

    }
}

