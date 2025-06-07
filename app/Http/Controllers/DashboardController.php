<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\WasteEntry;
use App\Models\WasteOutflow;
use App\Models\ReduksiSampah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    // Data ringkasan (seperti sebelumnya)
    $totalLokasiTPS = Location::count();
    $totalSampahMasuk = WasteEntry::sum('amount_kg');
    $totalSampahKeluar = WasteOutflow::sum('amount_kg');
    $totalReduksi = ReduksiSampah::sum('reduksi_kg');

    $masuk = DB::table('waste_entries')
    ->select('entry_date as date', DB::raw('SUM(amount_kg) as masuk'), DB::raw('0 as keluar'))
    ->groupBy('entry_date');

$keluar = DB::table('waste_outflows')
    ->select('outflow_date as date', DB::raw('0 as masuk'), DB::raw('SUM(amount_kg) as keluar'))
    ->groupBy('outflow_date');

$tanggalSampah = $masuk->unionAll($keluar)->get();

// Kelompokkan hasil akhir berdasarkan tanggal (masih pakai Collection Laravel)
$tanggalSampah = collect($tanggalSampah)
    ->groupBy('date')
    ->map(function ($group) {
        return [
            'date' => $group->first()->date,
            'masuk' => $group->sum('masuk'),
            'keluar' => $group->sum('keluar'),
        ];
    })
    ->values();

    // Data reduksi per tanggal
    $reduksiData = ReduksiSampah::select('reduction_date as date', 'persentase_reduksi')->get();

    return view('coba.dashboard', compact(
        'totalLokasiTPS',
        'totalSampahMasuk',
        'totalSampahKeluar',
        'totalReduksi',
        'tanggalSampah',
        'reduksiData'
    ));
}
}
