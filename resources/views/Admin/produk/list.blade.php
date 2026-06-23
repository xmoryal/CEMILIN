@extends('Layouts.admin.app')

@section('content')
  <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>List Produk</h3>
        </div>

        <div class="card mb-4 p-2">

            <!-- Kolom pencarian -->
            <div class="card-header">
                <form class="d-flex" role="search" method="GET" action="{{ route('penjual.produk.index') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari produk"
                        aria-label="Search" value="" />
                    <button class="btn btn-outline-success me-2" type="submit">Cari</button>

                    @if (request()->filled('search'))
                        <a href="{{ route('penjual.produk.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <!-- table produk -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                                <th>Dibuat pada</th>
                                <th>Diedit pada</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('assets/img/produk/' . $item->foto) }}" width="100">
                                    </td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ number_format($item->stok) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- pagination --}}
            <div class="justify-content-center">
                {{ $produk->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection