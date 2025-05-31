@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Input Sampah Masuk</h2>
    <form action="{{ route('waste_entries.store') }}" method="POST">
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
            <label for="entry_date" class="form-label">Tanggal Masuk</label>
            <input type="date" name="entry_date" id="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="amount_kg" class="form-label">Jumlah Sampah Masuk (kg)</label>
            <input type="number" step="0.01" name="amount_kg" id="amount_kg" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
