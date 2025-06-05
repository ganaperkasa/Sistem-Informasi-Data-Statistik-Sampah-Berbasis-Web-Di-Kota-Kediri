@extends('layouts.master')
@section('title', 'Data Sampah Keluar')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengelolaan Sampah /</span> Daftar Sampah Keluar</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Sampah Keluar</h5>
            <a href="{{ route('waste_outflows.create') }}" class="btn rounded-pill btn-primary btn-md">Tambah Sampah Keluar</a>
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
                            <th>Sampah Keluar (kg)</th>

                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @forelse ($sampahKeluar as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->location->name }}</td>
                                <td>{{ $data->outflow_date }}</td>
                                <td>{{ $data->amount_kg }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data sampah keluar.</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

    </div>
    @endsection
