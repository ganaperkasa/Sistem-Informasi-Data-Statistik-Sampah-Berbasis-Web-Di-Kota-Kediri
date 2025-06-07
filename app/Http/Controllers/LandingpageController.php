<?php

namespace App\Http\Controllers;

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
        return view('landingpage', [
            'tahun' => $tahun,
            'reduksiData' => $reduksiData,
            'tps' => $tpsName,
            'spt' => $tps,
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
