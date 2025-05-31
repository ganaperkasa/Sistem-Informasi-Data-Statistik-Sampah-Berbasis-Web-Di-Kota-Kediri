@extends('layouts.master')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sampah Keluar/</span> Tambah Sampah Keluar</h4>

              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Tambah Sampah Keluar</h5>
                    </div>
                    <div class="card-body">
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

                            <button type="submit" class="btn rounded-pill btn-primary">Simpan</button>
                            <a href="{{ route('waste_outflows.index') }}"  class="btn rounded-pill btn-danger">Batal</a>
                        </form>


                    </div>
                  </div>
                </div>
                <!-- Basic with Icons -->

              </div>

@endsection
