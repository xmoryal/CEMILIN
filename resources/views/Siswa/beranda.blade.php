@extends('Layouts.siswa.app')

@section('content')
<body class="p-5">
    <section class="container mt-3">
      <div class="row g-4 p-3" id="product-grid">
        <!-- Kolom pencarian -->
            <div>
                <form class="d-flex" role="search" method="GET" action="{{ route('siswa.beranda') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari produk"
                        aria-label="Search" value="" />
                    <button class="btn btn-outline-success me-2" type="submit">Cari</button>

                    @if (request()->filled('search'))
                        <a href="{{ route('siswa.beranda') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
              </div>
        
        @foreach ($produk as $produks)
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <article class="card product-card h-100">
            <div class="position-relative">
              <a href="{{ route('siswa.detail', $produks->id) }}">
              <img src="{{ asset('assets/img/produk/' . $produks->foto) }}" class="card-img-top w-100" >
              </a>  
            </div>
            <div class="card-body d-flex flex-column">
              <h3 class="card-title h6 mb-1"><b>{{ $produks->nama_produk }}</b></h3>
              <p class="card-text small mb-3">Deskripsi : <br>{{ $produks->deskripsi }}</p>

              <div class="mt-auto">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <div>
                    <div class="price fw-bold">Rp. {{ number_format($produks->harga) }}</div>
                    <div class="small text-muted">Stok: <span class="fw-semibold">{{ $produks->stok }}</span></div>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>
        @endforeach

      </div>
    </section>
</body>
@endsection

@push('css')
<style>
:root{
  --brand: #ff6b3d;
  --muted: #6c757d;
}

/* Reset kecil untuk card product */
.product-card{
  border: 3px solid rgba(0,0,0,0.06); /* batas besar sesuai permintaan */
  border-radius: 1rem;
  overflow: hidden;
  transition: transform .18s ease, box-shadow .18s ease;
}
.product-card:hover{
  transform: translateY(-6px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.card-img-top{
  height: 160px;
  object-fit: cover;
}

.price{
  color: var(--brand);
}

.seller a{ color: inherit; }

/* Responsive tweaks */
@media (max-width: 576px){
  .card-img-top{ height: 200px; }
  header .input-group{ display:none !important; }
}

/* tombol kecil */
.btn-sm{
  padding: .35rem .6rem;
  border-radius: .5rem;
}

/* footer spacing */
footer{ margin-top: 3rem; }
</style>
@endpush


