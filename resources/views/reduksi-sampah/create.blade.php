@extends('layouts.master')
@section('title', 'Tambah Reduksi Sampah')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Hitung Reduksi Sampah</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
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
                  </div>
                </div>
                <!-- Basic with Icons -->

              </div>

@endsection
