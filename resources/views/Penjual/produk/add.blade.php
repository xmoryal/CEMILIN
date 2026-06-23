@extends('Layouts.kantin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Tambah produk</h3>
        </div>

        <div class="card mb-4 p-3">
            <form action="{{ route('penjual.produk.add.post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="mb-3">   
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                            <option disabled selected>-- pilih kategori --</option>

                            @foreach ( $kategori as $kategoris)
                                <option value="{{ $kategoris->id }}">{{ $kategoris->kategori }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                          @error('kategori_id')
                            {{ $message }}
                          @enderror
                        </div>

                    </div>

                    <div class="mb-3">
                        <label>Gambar Produk</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                        <div class="invalid-feedback">
                          @error('foto')
                            {{ $message }}
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_produk">Nama produk</label>
                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}">
                        <div class="invalid-feedback">
                          @error('nama_produk')
                            {{ $message }}
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                        <div class="invalid-feedback">
                          @error('deskripsi')
                            {{ $message }}
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                        <div class="invalid-feedback">
                          @error('harga')
                            {{ $message }}
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}">
                        <div class="invalid-feedback">
                          @error('stok')
                            {{ $message }}
                          @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="tambah">
                        <a href="{{ route('penjual.produk.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
        </div>
    </main>
@endsection
