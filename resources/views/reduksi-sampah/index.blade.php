@extends('layouts.master')
@section('title', 'Data Reduksi Sampah')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Reduksi Sampah /</span> Daftar Reduksi Sampah</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Reduksi Sampah</h5>
            <a href="{{ route('reduksi_sampah.create') }}" class="btn rounded-pill btn-primary btn-md">Tambah Data Reduksi</a>
        </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- <a href="{{ route('reduksi_sampah.create') }}" class="btn btn-primary mb-3">Tambah Data Reduksi</a> --}}


            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Sampah Masuk (kg)</th>
                            <th>Sampah Keluar (kg)</th>
                            <th>Reduksi (kg)</th>
                            <th>Persentase Reduksi (%)</th>


                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @forelse ($reduksiSampah as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->location->name }}</td>
                                <td>{{ $data->reduction_date }}</td>
                                <td>{{ $data->sampah_masuk }}</td>
                                <td>{{ $data->sampah_keluar }}</td>
                                <td>{{ $data->reduksi_kg }}</td>
                                <td>{{ $data->persentase_reduksi }}</td>
                                {{-- <td>
                                    <a href="{{ route('reduksi_sampah.edit', $data->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('reduksi_sampah.destroy', $data->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data reduksi sampah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

    </div>
    @endsection
