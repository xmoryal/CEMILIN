<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil Siswa</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Style -->
  <style>
    body {
      margin-top: 10vh;
      margin-bottom: 10vh;
      padding: 2vh;
    }

    .text-oren {
      color: #db7e04;
    }

    .navbar-brand {
      font-weight: 600;
      color: white !important;
      letter-spacing: 0.5px;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      color: white;
      font-weight: 600;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }

    .form-label.required::after {
      content: " *";
      color: #d63384;
      font-weight: bold;
    }

    .img-preview {
      object-fit: cover;
      width: 100%;
      height: 100%;
      border-radius: 8px;
      border: 1px solid #64ff03;
    }
  </style>
</head>
<body class="justify-content-center d-flex">

  <!-- Page Content -->
    <div class="row">
      <div>
        <div class="card">
          <div class="card-header d-flex justify-content-between bg-success">
            <span>Edit Profil siswa</span>
          </div>

          <div class="card-body">
            <form class="row g-4" action="{{ route('siswa.profile.post', $siswa->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- Kolom Kiri -->
              <div class="col-12 col-md-4 text-center">
                <label class="form-label fw-semibold mb-2">Foto siswa</label>
                <div class="ratio ratio-1x1 mx-auto" style="width:160px;">
                  @if(!empty($siswa->foto) && file_exists(public_path('assets/img/profile/' . $siswa->foto)))
                    <img src="{{ asset('assets/img/profile/' . $siswa->foto) }}" class="img-preview" alt="Foto siswa">
                  @else
                    <img src="{{ asset('assets/img/profile/siswa.png') }}" class="img-preview" alt="Foto siswa">
                  @endif
                </div>

                <input class="form-control form-control-sm mt-3" type="file" name="foto" accept="image/*">
                <small class="text-muted d-block mt-1">Format: JPG, PNG dst...</small>

                <div class="mt-4 text-start">
                  <label for="username" class="form-label">username</label>
                  <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" value="{{ old('username', $siswa->username) }}">
                  @error('username')
                    <div class="invalid-feedback">username sudah digunakan</div>
                  @enderror
                  <small class="text-muted">ubah sesuai kemauan anda</small>
                </div>

              </div>

              <!-- Kolom Kanan -->
              <div class="col-12 col-md-8">
                <div class="mb-3">
                  <label class="form-label required">Nama siswa</label>
                  <input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa', $siswa->nama) }}" disabled>
                  <small class="text-muted">Tidak dapat diubah.</small>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}" disabled>
                    <small class="text-muted">Tidak dapat diubah.</small>  
                  </div>
                </div>

                <hr>

                <h6 class="fw-bold mb-2 text-success">Ganti Password (opsional)</h6>
                <div class="row">
                  <div class="input-group">
                        <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                        <button id="togglePassword" type="button" class="btn btn-outline-secondary" title="Tampilkan password">lihat</button>
                    </div>
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                  <button type="submit" class="btn btn-success" onclick="return confirm('yakin mau diubah?, data akan berubah loh..')">💾 Simpan Perubahan</button>
                  <a href="{{ route('siswa.beranda') }}" class="btn btn-outline-success">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>

    </div>

  <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        // update button text
        toggleBtn.innerText = type === 'password' ? 'lihat' : 'tutup';
    });
});
</script>
</body>
</html>
