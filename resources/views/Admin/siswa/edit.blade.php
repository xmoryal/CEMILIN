@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Edit Siswa</h3>
        </div>

        <div class="card mb-4 p-3">
            <form action="{{ route('admin.siswa.edit.post', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama lengkap</label>
                    <input type="text" value="{{ old('nama', $siswa->nama) }}" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="masukan nama lengkap" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="kelas" class="form-select" aria-label="Default select example">
                        <option selected>{{ old('kelas', $siswa->kelas) }}</option>
                        <option value="{{ 7 }}">7</option>
                        <option value="{{ 8 }}">8</option>
                        <option value="{{ 9 }}">9</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('yakin mau disimpan?, data akan berubah loh..')">Simpan</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </main>
@endsection

