<?php

namespace App\Http\Controllers;

use App\Models\WasteEntry;
use App\Models\Location;
use Illuminate\Http\Request;

class WasteEntryController extends Controller
{
    public function index()
{
    $sampahMasuk = WasteEntry::with('location')->get();
    return view('sampah-masuk.index', compact('sampahMasuk'));
}
    public function create()
    {
        $locations = Location::all();
        return view('sampah-masuk.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'entry_date' => 'required|date',
            'amount_kg' => 'required|numeric|min:0',
        ]);

        WasteEntry::create($request->only(['location_id', 'entry_date', 'amount_kg']));

        return redirect()->route('waste_entries.index')->with('success', 'Data sampah masuk berhasil disimpan.');
    }
}
