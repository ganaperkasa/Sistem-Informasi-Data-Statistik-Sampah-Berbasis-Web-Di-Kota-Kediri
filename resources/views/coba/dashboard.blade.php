@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Grafik Sampah (Kiri Besar) -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="m-0">Grafik Total Sampah Masuk & Keluar</h5>
            </div>
            <div class="card-body">
                <div id="sampahChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Data (Kanan) -->
    <div class="col-lg-4 mb-4">
        <div class="row">
            <!-- Total TPS -->
            <div class="col-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="avatar mb-2 mx-auto" style="width: 50px; height: 50px;">
                            <img src="../assets/img/icons/unicons/paypal.png" alt="icon" class="rounded" />
                        </div>
                        <span class="fw-semibold d-block">Total Lokasi TPS</span>
                        <h3 class="card-title mb-0">{{ $totalLokasiTPS }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Sampah Masuk -->
            <div class="col-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="avatar mb-2 mx-auto" style="width: 50px; height: 50px;">
                            <img src="../assets/img/icons/unicons/cc-success.png" alt="icon" class="rounded" />
                        </div>
                        <span class="fw-semibold d-block">Sampah Masuk (Kg)</span>
                        <h3 class="card-title mb-0">{{ number_format($totalSampahMasuk, 2) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Sampah Keluar -->
            <div class="col-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="avatar mb-2 mx-auto" style="width: 50px; height: 50px;">
                            <img src="../assets/img/icons/unicons/cc-warning.png" alt="icon" class="rounded" />
                        </div>
                        <span class="fw-semibold d-block">Sampah Keluar (Kg)</span>
                        <h3 class="card-title mb-0">{{ number_format($totalSampahKeluar, 1) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Reduksi -->
            <div class="col-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="avatar mb-2 mx-auto" style="width: 50px; height: 50px;">
                            <img src="../assets/img/icons/unicons/chart.png" alt="icon" class="rounded" />
                        </div>
                        <span class="fw-semibold d-block">Reduksi Sampah (Kg)</span>
                        <h3 class="card-title mb-0">{{ number_format($totalReduksi, 1) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Reduksi Per Bulan -->
<div class="card">
    <div class="card-header">
        <h5 class="m-0">Persentase Reduksi Sampah per Bulan (Stacked per TPS)</h5>
    </div>
    <div class="card-body">
        <div id="reduksiChart" style="height: 400px;"></div>
    </div>
</div>



    @push('js')
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tanggalSampah = @json($tanggalSampah ?? []);
                const reduksiData = @json($reduksiData ?? []);
                // console.log("reduksiData", reduksiData);

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

                const bulanLabels = [...new Set(reduksiData.map(item => item.bulan))];
                const tpsSeriesData = {};
                reduksiData.forEach(item => {
                    const tps = item.nama_tps;
                    if (!tpsSeriesData[tps]) {
                        tpsSeriesData[tps] = {};
                    }
                    tpsSeriesData[tps][item.bulan] = item.persentase_reduksi;
                });

                // Format jadi array series untuk ApexCharts
                const series = Object.entries(tpsSeriesData).map(([name, bulanObj]) => {
                    return {
                        name,
                        data: bulanLabels.map(bulan => bulanObj[bulan] ?? 0)
                    };
                });
                new ApexCharts(document.querySelector("#reduksiChart"), {
                    chart: {
                        type: 'bar',
                        stacked: true,
                        height: 400,
                        toolbar: {
                            show: true
                        }
                    },
                    series,
                    xaxis: {
                        categories: bulanLabels,
                        title: {
                            text: "Bulan"
                        }
                    },
                    yaxis: {
                        title: {
                            text: "Reduksi (%)"
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: val => `${val}%`
                        }
                    },
                    legend: {
                        position: 'top',
                        offsetY: 0
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    fill: {
                        opacity: 1
                    },

                }).render();



            });
        </script>
    @endpush


@endsection
