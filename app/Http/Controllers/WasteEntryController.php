<?php

namespace App\Http\Controllers;

use App\Models\WasteEntry;
use App\Models\Location;
use Illuminate\Http\Request;

class WasteEntryController extends Controller
{
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

        return redirect()->back()->with('success', 'Data sampah masuk berhasil disimpan.');
    }
}
