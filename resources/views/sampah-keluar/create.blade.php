@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Input Sampah Keluar</h2>
    <form action="{{ route('waste_outflows.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="location_id" class="form-label">Lokasi TPS</label>
            <select name="location_id" id="location_id" class="form-select" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="outflow_date" class="form-label">Tanggal Keluar</label>
            <input type="date" name="outflow_date" id="outflow_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="amount_kg" class="form-label">Jumlah Sampah Keluar (kg)</label>
            <input type="number" step="0.01" name="amount_kg" id="amount_kg" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
