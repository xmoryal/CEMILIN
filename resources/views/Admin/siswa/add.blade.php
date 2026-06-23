@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Tambah Siswa</h3>
        </div>

        <div class="card mb-4 p-3">
            <form action="{{ route('admin.siswa.add.post') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama lengkap</label>
                    <input type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="masukan nama lengkap" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="kelas" class="form-select" aria-label="Default select example">
                        <option disabled selected>-- Pilih kelas --</option>
                        <option value="{{ 7 }}">7</option>
                        <option value="{{ 8 }}">8</option>
                        <option value="{{ 9 }}">9</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">pilih kelasnya dulu oy!</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="masukan username" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="masukan password" required>
                        <button id="togglePassword" type="button" class="btn btn-outline-secondary" title="Tampilkan password">lihat</button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </main>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    if (!toggleBtn || !passwordInput) return;

    toggleBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        // update button title
        toggleBtn.setAttribute('title', type === 'password' ? 'Tampilkan password' : 'Sembunyikan password');
        // optional: change icon/text
        toggleBtn.innerText = type === 'password' ? 'lihat' : 'tutup';
    });
});
</script>
@endpush
