@extends('Layouts.siswa.app')

@section('content')
<main class="container my-5">
  <!-- PRODUCT DETAIL -->
  <section>
    <nav class="p-2 mb-2">
        <h3>Detail Produk</h3>
    </nav>
    <div class="row g-4">
      <div class="col-lg-5">    
        <div class="img-fluid">
          <!-- Placeholder image -->
          <img id="mainImage" src="{{ asset('assets/img/produk/' . $produk->foto) }}" class="rounded w-100">
        </div>
      </div>

      <div class="col-lg-7">
        <h2 class="mb-1"> {{ $produk->nama_produk }}</h2>
        <p class="text-muted">Kategori : <span class="text-body">{{ $produk->kategori }}</span></p>

        <div class="mb-3">
          <span class="strike text-danger"><h5><b>Rp. {{ number_format($produk->harga) }}</b></h5></span>
        </div>

        <p>Stok : <b>{{ $produk->stok }}</b></p>
        <p>Kantin : <b>{{ $produk->nama_kantin }}</b></p>

        <div class="d-flex align-items-center mb-3">
          <label class="me-2 mb-0">Jumlah:</label>
          <div class="input-group" style="width:140px;">
            <button class="btn btn-outline-secondary" id="qtyMinus">-</button>
            <input type="number" id="qty" class="form-control text-center" value="1" min="1" max="12">
            <button class="btn btn-outline-secondary" id="qtyPlus">+</button>
          </div>
        </div>

        <div class="">
         <a href="{{ route('siswa.cekout.produk', $produk->id) }}" class="btn btn-sm btn-success me-2">Cekout</a>
         <button class="btn btn-sm btn-outline-primary" onclick="addToCart({{ $produk->id }})">+ Keranjang</button>
         <a class="btn btn-outline-warning" href="{{ route('siswa.beranda') }}">Kembali</a>
        </div>

        <hr class="my-4">
        <h6>Deskripsi</h6>
        <p>{{ $produk->deskripsi }}</p>

      </div>
    </div>
</section>

</main>
@endsection

@push('css')
<style>
    .product-image {
      background-color: #f8f9fa;
      border-radius: .5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 300px;
    }
    .price { font-size: 1.65rem; font-weight: 700; }
    .strike { text-decoration: line-through; color: #6c757d; }
    .badge-tight { padding: .35em .5em; border-radius: .35rem; }
    .step { width: 36px; height: 36px; border-radius: 50%; display:inline-flex; align-items:center; justify-content:center; }
</style>
@endpush

@push('js')
    <script>
        // Inisialisasi
        const qtyInput = document.getElementById('qty');
        const qtyMinus = document.getElementById('qtyMinus');
        const qtyPlus = document.getElementById('qtyPlus');
        const maxStok = {{ $produk->stok }};

        // buat tombol minusnya
        qtyMinus.addEventListener('click', function() {
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        });

        // tombol plus
        qtyPlus.addEventListener('click', function() {
            let currentQty = parseInt(qtyInput.value);
            if (currentQty < maxStok) {
                qtyInput.value = currentQty + 1;
            } else {
                alert('Stok maksimal hanya ' + maxStok);
            }
        });

        // biar gak ngelewatin batas max stok
        qtyInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxStok) {
                this.value = maxStok;
                alert('Stok maksimal hanya ' + maxStok);
            }
        });

        // tambah ke cart dengan fungsi java script
        function addToCart(id) {
            const qty = parseInt(qtyInput.value);
            fetch("{{ route('siswa.addToCart') }}?id=" + id + "&qty=" + qty)
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data);
                alert(data.info);
                qtyInput.value = 1; // reset ke 1 setelah berhasil
            })
            .catch(error => {
                console.error('error fetch:', error);
            })
        }
    </script>
@endpush
  


