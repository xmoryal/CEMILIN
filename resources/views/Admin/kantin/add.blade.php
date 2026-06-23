@extends('Layouts.admin.app')

@section('content')
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Tambah Kantin</h3>
        </div>

        <div class="card mb-4 p-3">
            <form action="{{ route('admin.kantin.add.post') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="nama_kantin" class="form-label">nama Kantin</label>
                    <input type="text" value="{{ old('nama_kantin') }}" class="form-control @error('nama_kantin') is-invalid @enderror" name="nama_kantin" placeholder="masukan nama kantin" required>
                    @error('nama_kantin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="masukan email" required>
                    @error('email')
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
                <a href="{{ route('admin.kantin.index') }}" class="btn btn-secondary">Batal</a>
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
