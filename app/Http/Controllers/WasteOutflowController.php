<?php

namespace App\Http\Controllers;

use App\Models\WasteOutflow;
use App\Models\Location;
use Illuminate\Http\Request;

class WasteOutflowController extends Controller
{
    public function index()
{
    $sampahKeluar = WasteOutflow::with('location')->get();
    return view('sampah-keluar.index', compact('sampahKeluar'));
}
    public function create()
    {
        $locations = Location::all();
        return view('sampah-keluar.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'outflow_date' => 'required|date',
            'amount_kg' => 'required|numeric|min:0',
        ]);

        WasteOutflow::create($request->only(['location_id', 'outflow_date', 'amount_kg']));

        return redirect()->route('waste_outflows.index')->with('success', 'Data sampah keluar berhasil disimpan.');
    }
}
