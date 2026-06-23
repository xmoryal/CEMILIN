<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Edit Profil Penjual | Kantin Sekolah</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Style -->
  <style>
    body {
      background: #f4fff6;
      font-family: 'Poppins', sans-serif;
    }

    .navbar {
      background: linear-gradient(90deg, #47c35a, #62d96f);
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
      background-color: #47c35a;
      color: white;
      font-weight: 600;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }

    .btn-primary {
      background-color: #47c35a;
      border-color: #47c35a;
    }

    .btn-primary:hover {
      background-color: #3da14c;
    }

    .btn-outline-secondary:hover {
      background-color: #eee;
    }

    .form-label.required::after {
      content: " *";
      color: #d63384;
      font-weight: bold;
    }

    footer {
      text-align: center;
      padding: 15px 0;
      color: #666;
      font-size: 14px;
    }

    .img-preview {
      object-fit: cover;
      width: 100%;
      height: 100%;
      border-radius: 8px;
      border: 3px solid #d2ffd9;
    }
  </style>
</head>
<body class="p-5">

  <!-- Page Content -->
  <div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span>Edit Profil Penjual</span>
            <a href="{{ route('penjual.dashboard', $penjual->id) }}" class="btn btn-sm btn-light">← Kembali</a>
          </div>

          <div class="card-body p-4">
            <form class="row g-4" action="{{ route('penjual.profile.edit.post', $penjual->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <!-- Kolom Kiri -->
              <div class="col-12 col-md-4 text-center">
                <label class="form-label fw-semibold mb-2">Foto Kantin</label>
                <div class="ratio ratio-1x1 mx-auto" style="width:160px;">
                  @if(!empty($penjual->foto) && file_exists(public_path('assets/img/profile/' . $penjual->foto)))
                    <img src="{{ asset('assets/img/profile/' . $penjual->foto) }}" class="img-preview" alt="Foto Kantin">
                  @else
                    <img src="{{ asset('assets/img/profile/toko.jpeg') }}" class="img-preview" alt="Foto Kantin">
                  @endif
                </div>

                <input class="form-control form-control-sm mt-3" type="file" name="foto" accept="image/*">
                <small class="text-muted d-block mt-1">Format: JPG, PNG. Max 2MB</small>

                <div class="mt-4 text-start">
                  <label class="form-label">Email (akun)</label>
                  <input type="email" class="form-control" value="{{ old('email', $penjual->email) }}" disabled>
                  <small class="text-muted">Tidak dapat diubah.</small>
                </div>

              </div>

              <!-- Kolom Kanan -->
              <div class="col-12 col-md-8">
                <div class="mb-3">
                  <label class="form-label required">Nama Kantin / Toko</label>
                  <input type="text" name="nama_kantin" class="form-control @error('nama_kantin') is-invalid @enderror" value="{{ old('nama_kantin', $penjual->nama_kantin) }}" required>
                  @error('nama_kantin')
                    <div class="invalid-feedback">Nama kantin sudah ada yang punya</div>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" value="{{ old('nama_bank', $penjual->nama_bank) }}" placeholder="Contoh: BCA">
                    @error('nama_bank')
                      <div class="invalid-feedback">Bank wajib diisi</div>
                    @enderror

                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">No. Rekening</label>
                    <input type="number" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ old('no_rekening', $penjual->no_rekening) }}" placeholder="xxxxxxx">
                    @error('no_rekening')
                      <div class="invalid-feedback">No Rekening wajib diisi</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Deskripsi Singkat</label>
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" >{{ old('deskripsi', $penjual->deskripsi) }}</textarea>
                  @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <hr>

                <h6 class="fw-bold mb-2 text-success">Ganti Password (opsional)</h6>
                <div class="row">
                    <div class="input-group">
                        <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" placeholder="masukan password baru">
                        <button id="togglePassword" type="button" class="btn btn-outline-secondary" title="Tampilkan password">
                            lihat
                        </button>
                    </div>
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-3">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('yakin mau diubah?, data akan berubah loh..')">💾 Simpan Perubahan</button>
                  <a href="{{ route('penjual.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>

        <footer class="mt-4">
          © 2025 Kantin Sekolah — Semua Hak Dilindungi 🍞
        </footer>
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
