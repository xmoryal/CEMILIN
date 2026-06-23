@extends('Layouts.admin.app')

@section('content')
 <main class="container py-4">
    <div class="row g-3">
      <div class="col-12 col-md-4">
        <div class="card card-stats">
          <div class="card-header text-center">Banyak Siswa</div>
          <div class="card-body text-center">
            <div class="stat-value">{{ $siswa }}</div>
            <div class="text-muted">Siswa terdaftar</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card card-stats">
          <div class="card-header text-center">Banyak Kantin</div>
          <div class="card-body text-center">
            <div class="stat-value">{{ $kantin }}</div>
            <div class="text-muted">Kantin aktif</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card card-stats">
          <div class="card-header text-center">Banyak Produk</div>
          <div class="card-body text-center">
            <div class="stat-value">{{ $produk }}</div>
            <div class="text-muted">Produk tersedia</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-header text-center">Ringkasan Pemasukan</div>
      <div class="card-body">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
          <div>
            <div class="text-muted">Total Pemasukan Bulan Ini</div>
            <div class="stat-value">Rp12.543.000</div>
          </div>
          <div class="mt-3 mt-lg-0" style="width:300px;height:140px;background:linear-gradient(90deg,#fff,#FFF3E0);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:.9rem">Grafik ringkasan (placeholder)</div>
        </div>
      </div>
    </div>

  </main>
@endsection
  
  
