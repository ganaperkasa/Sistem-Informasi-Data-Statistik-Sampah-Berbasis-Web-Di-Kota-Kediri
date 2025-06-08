<?php

namespace App\Http\Controllers;

use App\Models\WasteEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReduksiSampah;
use App\Models\Location;
use App\Models\Tps;

class LandingpageController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = $request->query('tahun', date('Y'));
        $tpsName = $request->query('tps');

        // Ambil data reduksi sampah
        $reduksiQuery = DB::table('reduksi_sampah')->join('locations', 'reduksi_sampah.location_id', '=', 'locations.id')->select('locations.name', DB::raw('SUM(reduksi_sampah.reduksi_kg) as reduksi_kg'))->whereYear('reduksi_sampah.reduction_date', $tahun);

        if ($tpsName) {
            $reduksiQuery->where('locations.name', $tpsName);
        }

        $reduksiData = $reduksiQuery->groupBy('locations.name')->get();

        // Ambil lokasi lengkap beserta relasi tps (pakai model)
        $locations = Location::with('tps')->get();
        $tps = Tps::with('location')->get();
        $masuk = WasteEntry::with('location')->get();
        $latestMasukPerLocation = $masuk
    ->sortByDesc('updated_at')
    ->groupBy('location_id')
    ->map(function ($group) {
        return $group->first(); // ambil satu data terbaru per lokasi
    });

    $reduksi = ReduksiSampah::with('location')->get();
    $latestreduksi = $reduksi ->sortByDesc('updated_at')
    ->groupBy('location_id')
    ->map(function ( $group) {
        return $group->first(); // ambil satu data terbaru per lokasi
    });
        $tps = Tps::with('location')->get();
        return view('landingpage', [
            'tahun' => $tahun,
            'reduksiData' => $reduksiData,
            'tps' => $tpsName,
            'spt' => $tps,
            'latestMasuk' => $latestMasukPerLocation,
            'latestReduksi' => $latestreduksi,
            'reduksi' => $reduksi,
            'locations' => $locations,
        ]);
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('landingpage.about');
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('landingpage.contact');
    }
}
