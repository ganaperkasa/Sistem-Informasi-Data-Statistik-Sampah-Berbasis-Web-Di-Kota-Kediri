@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Bagian Kiri Besar -->
    <div class="col-lg-8 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
            <div id="sampahChart" style="height: 300px;"></div>
          </div>
          <div class="col-md-4">
            <h6 class="text-center mt-3">Persentase Reduksi Sampah</h6>
            <div id="reduksiChart" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bagian Kanan -->
    <div class="col-lg-4 mb-4">
      <div class="row">
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <div class="avatar mx-auto mb-2" style="width: 50px; height: 50px;">
                <img src="../assets/img/icons/unicons/paypal.png" alt="icon" class="rounded" />
              </div>
              <span class="fw-semibold d-block mb-1">Total Lokasi TPS</span>
              <h3 class="card-title mb-0">{{ $totalLokasiTPS }}</h3>
            </div>
          </div>
        </div>

        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <div class="avatar mx-auto mb-2" style="width: 50px; height: 50px;">
                <img src="../assets/img/icons/unicons/cc-success.png" alt="icon" class="rounded" />
              </div>
              <span class="fw-semibold d-block mb-1">Total Sampah Masuk (Kg)</span>
              <h3 class="card-title mb-0">{{ number_format($totalSampahMasuk, 2) }}</h3>
            </div>
          </div>
        </div>

        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <div class="avatar mx-auto mb-2" style="width: 50px; height: 50px;">
                <img src="../assets/img/icons/unicons/cc-warning.png" alt="icon" class="rounded" />
              </div>
              <span class="fw-semibold d-block mb-1">Total Sampah Keluar (Kg)</span>
              <h3 class="card-title mb-0">{{ number_format($totalSampahKeluar, 1) }}</h3>
            </div>
          </div>
        </div>

        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <div class="avatar mx-auto mb-2" style="width: 50px; height: 50px;">
                <img src="../assets/img/icons/unicons/chart.png" alt="icon" class="rounded" />
              </div>
              <span class="fw-semibold d-block mb-1">Total Reduksi Sampah (kg)</span>
              <h3 class="card-title mb-0">{{ number_format($totalReduksi, 1) }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        </div>
    </div>


    @push('js')
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tanggalSampah = @json($tanggalSampah ?? []);
                const reduksiData = @json($reduksiData ?? []);

                console.log("✅ DOM Loaded");
                console.log("tanggalSampah", tanggalSampah);

                const labels = tanggalSampah.map(d => d.date);
                const dataMasuk = tanggalSampah.map(d => d.masuk ?? 0);
                const dataKeluar = tanggalSampah.map(d => d.keluar ?? 0);

                new ApexCharts(document.querySelector("#sampahChart"), {
                    chart: {
                        type: 'area',
                        height: 300
                    },
                    series: [{
                            name: "Masuk",
                            data: dataMasuk
                        },
                        {
                            name: "Keluar",
                            data: dataKeluar
                        }
                    ],
                    xaxis: {
                        categories: labels
                    }
                }).render();

                const reduksiLabels = reduksiData.map(d => d.date);
                const reduksiValues = reduksiData.map(d => d.persentase_reduksi ?? 0);

                new ApexCharts(document.querySelector("#reduksiChart"), {
                    chart: {
                        type: 'bar',
                        height: 300
                    },
                    series: [{
                        name: "Reduksi (%)",
                        data: reduksiValues
                    }],
                    xaxis: {
                        categories: reduksiLabels
                    }
                }).render();
            });
        </script>
    @endpush


@endsection
