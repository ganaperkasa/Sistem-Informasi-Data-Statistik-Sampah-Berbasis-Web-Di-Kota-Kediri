@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Hitung Reduksi Sampah</h2>
    <form action="{{ route('reduksi_sampah.calculate') }}" method="POST">
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
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Hitung Reduksi</button>
    </form>
</div>
@endsection
