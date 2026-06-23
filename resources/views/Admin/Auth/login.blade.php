<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin Kantin</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --bg-1: #0f1724; /* very dark navy */
      --bg-2: #0b1220; /* slightly lighter */
      --card: rgba(255,255,255,0.04);
      --accent: #7c3aed; /* elegant purple accent */
      --muted: rgba(255,255,255,0.65);
    }
    html,body{height:100%;}
    body{
      background: radial-gradient(1200px 600px at 10% 10%, rgba(124,58,237,0.12), transparent 5%),
                  radial-gradient(1000px 500px at 90% 90%, rgba(14,165,233,0.06), transparent 8%),
                  linear-gradient(180deg, var(--bg-1), var(--bg-2));
      color: #e6eef8;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:2rem;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    .login-card{
      width:100%;
      max-width:420px;
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border: 1px solid rgba(255,255,255,0.04);
      border-radius:16px;
      padding:2rem;
      box-shadow: 0 8px 30px rgba(2,6,23,0.6);
      backdrop-filter: blur(6px);
    }
    .brand{
      display:flex;
      gap:.75rem;
      align-items:center;
      margin-bottom:1.25rem;
    }
    .logo{
      width:48px;height:48px;border-radius:10px;display:grid;place-items:center;
      background:linear-gradient(135deg,var(--accent), #0ea5e9);
      font-weight:700;color:white;font-size:18px;box-shadow:0 6px 20px rgba(124,58,237,0.18);
    }
    .brand h4{margin:0;font-weight:700;font-size:1.05rem}
    .brand p{margin:0;font-size:.8rem;color:var(--muted)}
    .form-label{color:var(--muted);font-size:.85rem}
    .form-control,
    .form-control:focus{
      background: rgba(255,255,255,0.02);
      border:1px solid rgba(255,255,255,0.06);
      color: #e6eef8;
      box-shadow:none;
      border-radius:10px;
      padding: .9rem .85rem;
    }
    .form-control::placeholder{color:rgba(255,255,255,0.35)}
    .btn-primary{
      background: linear-gradient(90deg,var(--accent), #0ea5e9);
      border: none;
      padding: .7rem 1rem;
      border-radius:10px;
      box-shadow: 0 8px 18px rgba(124,58,237,0.18);
      font-weight:600;
    }
    .muted-link{color:var(--muted);font-size:.9rem}
    .divider{height:1px;background:rgba(255,255,255,0.03);margin:1rem 0;border-radius:4px}
    @media (max-width:420px){
      body{padding:1rem}
      .login-card{padding:1.25rem}
    }
  </style>
</head>
<body>
  <main class="login-card">
    <div class="brand">
      <div class="logo">K</div>
      <div>
        <h4>Admin Kantin</h4>
        <p>Masuk untuk mengelola penjual & pemasukan</p>
      </div>
    </div>

    <form action="{{ route('admin.login.post') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="masukan email" required value="{{ old('email') }}">
        @error('email')
          <div class="invalid-feedback">email atau password salah</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required>
          @error('password')
          <div class="invalid-feedback">email atau password salah</div>
          @enderror
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Masuk</button>
      </div>

    </form>
    <div class="text-center mt-3">
       <b>hanya petugas resmi yang berhak masuk</b><br>
       lupa password? <a href="">Lapor admin</a>
    </div>
  </main>

  <!-- Bootstrap 5 JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
