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

        $totalLokasiTPS = Location::count();
        $totalSampahMasuk = WasteEntry::sum('amount_kg');
        $totalSampahKeluar = WasteOutflow::sum('amount_kg');
        $totalReduksi = ReduksiSampah::sum('reduksi_kg');

        $masuk = DB::table('waste_entries')->select('entry_date as date', DB::raw('SUM(amount_kg) as masuk'), DB::raw('0 as keluar'))->groupBy('entry_date');

        $keluar = DB::table('waste_outflows')->select('outflow_date as date', DB::raw('0 as masuk'), DB::raw('SUM(amount_kg) as keluar'))->groupBy('outflow_date');

        $tanggalSampah = $masuk->unionAll($keluar)->get();


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
        $reduksiData = DB::table('reduksi_sampah')
    ->join('locations', 'reduksi_sampah.location_id', '=', 'locations.id')
    ->selectRaw('
        locations.name as nama_tps,
        DATE_FORMAT(reduksi_sampah.reduction_date, "%Y-%m") as bulan,
        SUM(reduksi_sampah.sampah_masuk) as total_masuk,
        SUM(reduksi_sampah.reduksi_kg) as total_reduksi,
        ROUND((SUM(reduksi_sampah.reduksi_kg) / NULLIF(SUM(reduksi_sampah.sampah_masuk), 0)) * 100, 2) as persentase_reduksi
    ')
    ->groupBy('locations.name', DB::raw('DATE_FORMAT(reduksi_sampah.reduction_date, "%Y-%m")'))
    ->orderBy('locations.name')
    ->get();

        return view('coba.dashboard', compact('totalLokasiTPS', 'totalSampahMasuk', 'totalSampahKeluar', 'totalReduksi', 'tanggalSampah', 'reduksiData'));
    }
}
