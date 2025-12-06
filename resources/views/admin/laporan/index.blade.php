@extends('admin.layout')

@section('content')

<h2 class="mb-4">Grafik Pertumbuhan Pengguna Tahun {{ $tahun }}</h2>

{{-- ================= TOMBOL DOWNLOAD ================= --}}
<div class="mb-4 d-flex gap-2">
    <a href="{{ route('admin.laporan.pdf', ['year' => $tahun]) }}"
       class="btn btn-danger" target="_blank">
        Download PDF
    </a>

    <a href="{{ route('admin.laporan.excel', ['type' => 'pertumbuhan', 'year' => $tahun]) }}"
       class="btn btn-success">
        Excel Pertumbuhan
    </a>

    <a href="{{ route('admin.laporan.excel', ['type' => 'golongan', 'year' => $tahun]) }}"
       class="btn btn-success">
        Excel Golongan
    </a>

    <a href="{{ route('admin.laporan.excel', ['type' => 'status', 'year' => $tahun]) }}"
       class="btn btn-success">
        Excel Status
    </a>
</div>

{{-- ================= GRAFIK 1 ================= --}}
<div class="card p-4 mb-5">
    <canvas id="growthChart" height="100"></canvas>
</div>

<hr>

<h4>Statistik Golongan Darah Per Bulan Tahun {{ $tahun }}</h4>

{{-- ================= GRAFIK 2 ================= --}}
<div class="card p-4 mb-5">
    <canvas id="chartGolonganBulanan" height="120"></canvas>
</div>

<hr>

<h4>Status Permohonan Darah Rumah Sakit Saya - Tahun {{ $tahun }}</h4>

<div class="row mb-3">
    <div class="col-md-3"><b>Total:</b> {{ $totalPermohonan }}</div>
    <div class="col-md-3"><b>ACC:</b> {{ $totalAcc }}</div>
    <div class="col-md-3"><b>Reject:</b> {{ $totalReject }}</div>
    <div class="col-md-3"><b>Keberhasilan:</b> {{ $persenAcc }} %</div>
</div>

{{-- ================= GRAFIK 3 ================= --}}
<div class="card p-4 mb-5">
    <canvas id="chartStatusBatang" height="120"></canvas>
</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ===============================
   DATA DARI CONTROLLER (AMAN)
================================ */
const dataServer       = @json($bulanLengkap ?? []);
const golonganBulanan  = @json($golonganBulanan ?? []);
const grafikStatus     = @json($grafikStatus ?? ['acc'=>0,'reject'=>0]);

/* ===============================
   LABEL BULAN
================================ */
const bulanLabels = [
  'Jan','Feb','Mar','Apr','Mei','Jun',
  'Jul','Agu','Sep','Okt','Nov','Des'
];

/* ===============================
   1. GRAFIK PERTUMBUHAN
================================ */
const pendonorData = Object.values(dataServer).map(v => v?.pendonor ?? 0);
const penerimaData = Object.values(dataServer).map(v => v?.penerima ?? 0);

new Chart(document.getElementById('growthChart'), {
  type: 'line',
  data: {
    labels: bulanLabels,
    datasets: [
      { label: 'Pendonor', data: pendonorData, borderWidth: 2 },
      { label: 'Penerima', data: penerimaData, borderWidth: 2 }
    ]
  },
  options: { responsive: true }
});

/* ===============================
   2. GOLONGAN DARAH STACK
================================ */
const dataA  = Object.values(golonganBulanan).map(v => v?.A ?? 0);
const dataB  = Object.values(golonganBulanan).map(v => v?.B ?? 0);
const dataAB = Object.values(golonganBulanan).map(v => v?.AB ?? 0);
const dataO  = Object.values(golonganBulanan).map(v => v?.O ?? 0);

new Chart(document.getElementById('chartGolonganBulanan'), {
  type: 'bar',
  data: {
    labels: bulanLabels,
    datasets: [
      { label: 'A', data: dataA, stack: 's' },
      { label: 'B', data: dataB, stack: 's' },
      { label: 'AB', data: dataAB, stack: 's' },
      { label: 'O', data: dataO, stack: 's' }
    ]
  },
  options: {
    responsive: true,
    scales: {
      x: { stacked: true },
      y: { stacked: true }
    }
  }
});

/* ===============================
   3. STATUS ACC VS REJECT
================================ */
new Chart(document.getElementById('chartStatusBatang'), {
  type: 'bar',
  data: {
    labels: ['ACC', 'REJECT'],
    datasets: [{
      label: 'Jumlah',
      data: [grafikStatus.acc ?? 0, grafikStatus.reject ?? 0],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
@endsection
