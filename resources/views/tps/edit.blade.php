@extends('layouts.master')
@section('title', 'Edit Data TPS')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ups!</strong> Ada beberapa masalah dengan inputan Anda:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit TPS</h5>
                    {{-- <small class="text-muted float-end">Default label</small> --}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tps.update', $tps->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @php
                            $jam_operasional = $tps->jam_operasional ?? '';
                            $jam = explode(' - ', $jam_operasional);
                            $jam_buka = $jam[0] ?? '';
                            $jam_tutup = $jam[1] ?? '';
                        @endphp

                        {{-- Lokasi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Lokasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $tps->location->name }}" readonly>

                            </div>
                        </div>

                        {{-- Jumlah Pekerja --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jumlah Pekerja</label>
                            <div class="col-sm-10">
                                <input type="number" name="jumlah_pekerja" class="form-control"
                                    value="{{ $tps->jumlah_pekerja }}">
                            </div>
                        </div>

                        {{-- Luas --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Luas (m²)</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.01" name="luas" class="form-control"
                                    value="{{ $tps->luas }}">
                            </div>
                        </div>

                        {{-- Jam Operasional --}}

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jam Operasional</label>
                            <div class="col-sm-5">
                                <input type="time" name="jam_buka" class="form-control" value="{{ $jam_buka }}">
                            </div>
                            <div class="col-sm-5">
                                <input type="time" name="jam_tutup" class="form-control" value="{{ $jam_tutup }}">
                            </div>
                        </div>


                        {{-- Kapasitas TPS --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kapasitas TPS</label>
                            <div class="col-sm-10">
                                <input type="number" name="kapasitas_tps" class="form-control"
                                    value="{{ $tps->kapasitas_tps }}">
                            </div>
                        </div>

                        {{-- Fasilitas --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Fasilitas</label>
                            <div class="col-sm-10">
                                <textarea name="fasilitas" class="form-control">{{ $tps->fasilitas }}</textarea>
                            </div>
                        </div>

                        {{-- Foto Lokasi --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Foto Lokasi</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto_lokasi" class="form-control">
                                @if ($tps->foto_lokasi)
                                    <img src="{{ asset('storage/' . $tps->foto_lokasi) }}" alt="Foto" class="mt-2"
                                        width="150">
                                @endif
                            </div>
                        </div>

                        {{-- Ulasan --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ulasan</label>
                            <div class="col-sm-10">
                                <textarea name="ulasan" class="form-control">{{ $tps->ulasan }}</textarea>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn rounded-pill btn-primary">Update</button>
                                <a href="{{ route('tps.index') }}" class="btn rounded-pill btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!--/ Striped Rows -->



@endsection
