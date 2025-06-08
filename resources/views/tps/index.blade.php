@extends('layouts.master')
@section('title', 'Data TPS')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Data TPS /</span> Daftar TPS
    </h4>
    @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


    <div class="card">
        <h5 class="card-header">Daftar TPS</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama TPS</th>
                        <th>Jumlah Pekerja</th>
                        <th>Luas (m²) TPS</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($tps as $tp)
                        <tr>
                            <td>{{ $loop->iteration + $tps->firstItem() - 1 }}</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $tp->location->name ?? '-' }}</strong>
                            </td>
                            <td>{{ $tp->jumlah_pekerja }}</td>
                            <td>{{ $tp->luas }}</td>
                            <td>
                                <a href="{{ route('tps.edit', $tp->id) }}" class="btn rounded-pill btn-outline-primary ">Lengkapi</a>
                                <button type="button" class="btn rounded-pill btn-outline-info " data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $tp->id }}">
                                    Detail
                                </button>
                                <form action="{{ route('tps.destroy', $tp->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn rounded-pill btn-outline-danger"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Detail per TPS -->
                        <div class="modal fade" id="modalDetail{{ $tp->id }}" tabindex="-1"
                            aria-labelledby="modalDetailLabel{{ $tp->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title fw-bold text-white" id="modalDetailLabel{{ $tp->id }}">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            Detail TPS - {{ $tp->location->name ?? 'Tanpa Nama Lokasi' }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body p-4">
                                        <!-- Info Section -->
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="card border-0 bg-light">
                                                    <div class="card-body">
                                                        <h6 class="card-title text-primary mb-3">
                                                            <i class="fas fa-info-circle me-2"></i>Informasi TPS
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-clock text-warning me-2"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Jam
                                                                            Operasional</small>
                                                                        <strong>{{ $tp->jam_operasional ?? 'Tidak tersedia' }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-weight-hanging text-success me-2"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Kapasitas
                                                                            TPS</small>
                                                                        <strong>{{ $tp->kapasitas_tps ?? 'Tidak tersedia' }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-cogs text-info me-2"></i>
                                                                    <div>
                                                                        <small class="text-muted d-block">Fasilitas</small>
                                                                        <strong>{{ $tp->fasilitas ?? 'Tidak tersedia' }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gallery Section -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-primary mb-3">
                                                    <i class="fas fa-image me-2"></i>Foto Lokasi
                                                </h6>

                                                @if (!empty($tp->foto_lokasi))
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-8 col-lg-6">
                                                            <div class="card shadow-sm">
                                                                <div class="position-relative overflow-hidden"
                                                                    style="height: 300px;">
                                                                    <img src="{{ asset('storage/' . $tp->foto_lokasi) }}"
                                                                        class="card-img-top h-100 w-100 object-fit-cover"
                                                                        alt="Foto Lokasi TPS" data-bs-toggle="modal"
                                                                        data-bs-target="#imageModal{{ $tp->id }}"
                                                                        style="cursor: pointer; transition: transform 0.3s ease;"
                                                                        onmouseover="this.style.transform='scale(1.05)'"
                                                                        onmouseout="this.style.transform='scale(1)'">
                                                                    <div class="position-absolute top-0 end-0 p-2">
                                                                        <span class="badge bg-dark bg-opacity-75">
                                                                            <i class="fas fa-expand-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body p-3 text-center">
                                                                    <small class="text-muted">Klik untuk memperbesar</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5">
                                                        <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                                        <p class="text-muted mt-3 mb-0">Tidak ada foto lokasi tersedia</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i>Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview Modals -->
                        @if (!empty($tp->foto_lokasi))
                            <div class="modal fade" id="imageModal{{ $tp->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Foto Lokasi TPS</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <img src="{{ asset('storage/' . $tp->foto_lokasi) }}" class="img-fluid w-100"
                                                alt="Foto Lokasi TPS">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </tbody>
            </table>

        </div>
        @if($tps->hasPages())
        <div class="card-footer d-flex justify-content-between align-items-center">
            <!-- Info showing entries -->
            <div class="text-muted">
                Menampilkan {{ $tps->firstItem() }} sampai {{ $tps->lastItem() }}
                dari {{ $tps->total() }} data
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $tps->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
    </div>
@endsection
