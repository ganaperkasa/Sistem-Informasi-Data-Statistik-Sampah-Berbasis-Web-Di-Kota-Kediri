<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Tps;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create($validated);
        $tps = Tps::create([
            'locations_id' => $location->id,

        ]);
        return response()->json([
            'success' => true,
            'message' => 'Lokasi berhasil disimpan',
            'data' => [
                'location' => $location,
                'tps' => $tps,
            ]

        ]);
    }

    public function index()
{
    $locations = Location::with('tps')->get();


    return view('peta.show', compact('locations'));
}
}
