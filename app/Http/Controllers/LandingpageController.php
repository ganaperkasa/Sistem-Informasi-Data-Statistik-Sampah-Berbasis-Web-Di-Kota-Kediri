<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReduksiSampah;
use App\Models\Location;

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
    $tps = $request->query('tps');

    $query = DB::table('reduksi_sampah')
        ->join('locations', 'reduksi_sampah.location_id', '=', 'locations.id')
        ->select('locations.name', DB::raw('SUM(reduksi_sampah.reduksi_kg) as reduksi_kg'))
        ->whereYear('reduksi_sampah.reduction_date', $tahun);

    if ($tps) {
        $query->where('locations.name', $tps);
    }

    $data = $query->groupBy('locations.name')->get();

    $locations = DB::table('locations')
    ->join('tps', 'locations.id', '=', 'tps.locations_id')
    ->select(
        'locations.name',
        'tps.jam_operasional',
        'tps.kapasitas_tps',
        'tps.fasilitas',
        'tps.foto_lokasi'
    )
    ->get();
 // untuk dropdown TPS

    return view('landingpage', [
        'tahun' => $tahun,
        'reduksiData' => $data,
        'tps' => $tps,
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
