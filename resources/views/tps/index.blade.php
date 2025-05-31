@extends('layouts.master')
@section('title', 'Peta')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data TPS /</span> Daftar TPS</h4>

    <div class="card">
        <h5 class="card-header">Daftar TPS</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama TPS</th>
                <th>Jumlah Pekerja</th>
                <th>Luas TPS</th>
                <th>Jam Operasional</th>
                <th>Kapasitas TPS</th>
                <th>Fasilitas</th>
                <th>Foto</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($tps as $tp )

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $tp->location->name ?? '-' }}</strong></td>
                    <td>{{ $tp->jumlah_pekerja }}</td>
                    <td>{{ $tp->luas }}</td>
                    <td>{{ $tp->jam_operasional }}</td>
                    <td>{{ $tp->kapasitas_tps }}</td>
                    <td>{{ $tp->fasilitas }}</td>
                    <td>{{ $tp->foto }}</td>

                    <td>
                        <a href="{{ route('tps.edit', $tp->id) }}" class="btn btn-outline-primary">Edit</a>
                        <button type="button" class="btn btn-outline-danger">Delete</button>
                    </td>

                @endforeach



              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->





@endsection
