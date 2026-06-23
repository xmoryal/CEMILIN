@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Edit kategori</h3>
        </div>

        <div class="card mb-4 p-3">
            <form action="{{ route('admin.kategori.edit.post', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kategori" class="form-label">kategori</label>
                    <input type="text" value="{{ old('kategori', $kategori->kategori) }}" class="form-control @error('kategori') is-invalid @enderror" name="kategori" placeholder="masukan nama kategori" required>
                    @error('kategori')
                        <div class="invalid-feedback">kategori udah ada!, kalo g mau edit pencet batal!</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('yakin mau diedit?')">Simpan</button>
                <a href="{{ route('admin.kategori.list') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </main>
@endsection

