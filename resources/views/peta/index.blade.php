@extends('layouts.master')
@section('title', 'Peta')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
    <div class="col-md-12 col-lg-12 order-0 mb-4">
        <div class="card h-1000">
          <div class="card-body">

              <div id="map"></div>
              <!-- Make sure you put this AFTER Leaflet's CSS -->
              <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

          </div>
        </div>
      </div>

  </div>
</div>
@push('js');

<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-7.8211583, 112.0089698], 14);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Variabel global untuk marker baru
    var newMarker = null;

    // Handle klik peta
    map.on('click', function(e) {
      // Hapus marker sebelumnya jika ada
      if (newMarker) {
        map.removeLayer(newMarker);
      }

      // Buat marker baru
      newMarker = L.marker(e.latlng).addTo(map);

      // Tampilkan popup dengan form
      newMarker.bindPopup(`
        <div class="p-2">
          <h5 class="mb-2">Simpan Lokasi Baru</h5>
          <form id="saveLocationForm">
            <div class="mb-2">
              <label class="form-label">Nama Lokasi</label>
              <input type="text" name="name" class="form-control form-control-sm" placeholder="Masukkan nama">
            </div>
            <div class="mb-2">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" class="form-control form-control-sm" value="${e.latlng.lat}" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" class="form-control form-control-sm" value="${e.latlng.lng}" readonly>
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100">Simpan ke Database</button>
          </form>
        </div>
      `).openPopup();
    });

    // Tangani submit form
    document.addEventListener('submit', async function(e) {
      if (e.target && e.target.id === 'saveLocationForm') {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        try {
          const response = await fetch('{{ route("locations.store") }}', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              name: formData.get('name'),
              latitude: formData.get('latitude'),
              longitude: formData.get('longitude')
            })
          });

          const result = await response.json();

          if (result.success) {
            alert('Lokasi berhasil disimpan!');
            // Tutup popup setelah berhasil
            newMarker.closePopup();
          } else {
            alert('Gagal menyimpan: ' + (result.message || 'Error tidak diketahui'));
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Terjadi kesalahan jaringan');
        }
      }
    });
  </script>
@endpush

@endsection