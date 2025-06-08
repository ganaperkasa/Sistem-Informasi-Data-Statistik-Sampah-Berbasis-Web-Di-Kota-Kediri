@extends('layouts.master')
@section('title', 'Peta')
@section('content')

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
    @push('js')
        <script>
            // Inisialisasi peta
            var map = L.map('map').setView([-7.8267704, 112.0197845], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 26,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Tampilkan marker dari database
            @foreach ($locations as $location)
                // Buat marker untuk setiap lokasi
                var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);
                // Tampilkan tooltip (label) secara permanen

                marker.bindTooltip(
                    "{{ $location->name ?: 'Lokasi Tanpa Nama' }}", {
                        permanent: true,
                        direction: 'top',
                        className: 'my-labels' // Optional: untuk custom styling
                    }
                );

                // Tambahkan popup informasi
                marker.bindPopup(`
        <div class="p-2">
          <h5 class="mb-1">{{ $location->name ?: 'Lokasi Tanpa Nama' }}</h5>
          <div class="text-muted small">
            Latitude: {{ $location->latitude }}<br>
            Longitude: {{ $location->longitude }}
          </div>
          <div class="mt-1 small">
            <i class="bx bx-calendar"></i> {{ $location->created_at->format('d M Y') }}
          </div>
        </div>
      `);
            @endforeach

            // Jika ada lokasi, set view ke lokasi pertama
            @if ($locations->isNotEmpty())
                map.setView([{{ $locations[2]->latitude }}, {{ $locations[2]->longitude }}], 13);
            @endif
        </script>
    @endpush

@endsection
