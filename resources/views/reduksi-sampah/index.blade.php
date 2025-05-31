@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Data Reduksi Sampah</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('reduksi_sampah.create') }}" class="btn btn-primary mb-3">Tambah Data Reduksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Sampah Masuk (kg)</th>
                <th>Sampah Keluar (kg)</th>
                <th>Reduksi (kg)</th>
                <th>Persentase Reduksi (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reduksiSampah as $data)
                <tr>
                    <td>{{ $data->location->nama_lokasi }}</td>
                    <td>{{ $data->reduction_date }}</td>
                    <td>{{ $data->sampah_masuk }}</td>
                    <td>{{ $data->sampah_keluar }}</td>
                    <td>{{ $data->reduksi_kg }}</td>
                    <td>{{ $data->persentase_reduksi }}</td>
                    <td>
                        <a href="{{ route('reduksi_sampah.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('reduksi_sampah.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
