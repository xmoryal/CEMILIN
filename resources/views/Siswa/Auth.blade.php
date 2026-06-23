<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Cemilin</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --bg-1: #e8f5e9; /* lembut, cerah hijau */
      --bg-2: #c8e6c9; /* gradasi hijau pastel */
      --card: rgba(255,255,255,0.85);
      --accent: #2e7d32; /* hijau forest */
      --accent-2: #4caf50; /* hijau medium */
      --muted: #6b6b6b;
    }
    html,body{height:100%;}
    body{
      background: radial-gradient(1000px 600px at 20% 20%, rgba(76,175,80,0.25), transparent 40%),
                  radial-gradient(800px 400px at 80% 90%, rgba(46,125,50,0.25), transparent 50%),
                  linear-gradient(180deg, var(--bg-1), var(--bg-2));
      color: #333;
      font-family: 'Poppins', system-ui, sans-serif;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:2rem;
    }
    .login-card{
      width:100%;
      max-width:420px;
      background: var(--card);
      border: 2px solid rgba(46,125,50,0.1);
      border-radius:16px;
      padding:2rem;
      box-shadow: 0 8px 25px rgba(46,125,50,0.25);
      backdrop-filter: blur(8px);
    }
    .brand{
      display:flex;
      gap:.75rem;
      align-items:center;
      margin-bottom:1.25rem;
    }
    .logo{
      width:52px;height:52px;border-radius:12px;display:grid;place-items:center;
      background:linear-gradient(135deg,var(--accent), var(--accent-2));
      font-weight:700;color:white;font-size:20px;
      box-shadow:0 6px 20px rgba(46,125,50,0.4);
    }
    .brand h4{margin:0;font-weight:700;font-size:1.1rem;color:#2e7d32;}
    .brand p{margin:0;font-size:.85rem;color:var(--muted)}
    .form-label{color:var(--muted);font-size:.85rem;font-weight:500;}
    .form-control,
    .form-control:focus{
      background: rgba(255,255,255,0.9);
      border:1.5px solid rgba(46,125,50,0.3);
      color: #333;
      box-shadow:none;
      border-radius:10px;
      padding: .9rem .85rem;
    }
    .form-control::placeholder{color:rgba(120,120,120,0.55)}
    .btn-primary{
      background: linear-gradient(90deg,var(--accent), var(--accent-2));
      border: none;
      padding: .75rem 1rem;
      border-radius:10px;
      box-shadow: 0 8px 18px rgba(46,125,50,0.35);
      font-weight:600;
      color:white;
      transition: transform .15s ease, box-shadow .15s ease;
    }
    .btn-primary:hover{
      transform: translateY(-2px);
      box-shadow: 0 10px 22px rgba(46,125,50,0.4);
    }
    .muted-link{color:var(--muted);font-size:.9rem}
    .divider{height:1px;background:rgba(46,125,50,0.15);margin:1rem 0;border-radius:4px}
    a{
      color:var(--accent);
      text-decoration:none;
      font-weight:500;
    }
    a:hover{
      text-decoration:underline;
    }
    @media (max-width:420px){
      body{padding:1rem}
      .login-card{padding:1.25rem}
    }
  </style>
</head>
<body>
  <main class="login-card">
    <div class="brand">
      <div class="logo">🍉</div>
      <div>
        <h4>Login Cemilin</h4>
        <p>Masuk ke kantin online ceria!</p>
      </div>
    </div>

    <form action="{{ route('siswa.login.post') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan username" required value="{{ old('username') }}">
        @error('username')
          <div class="invalid-feedback">username atau password salah</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required value="{{ old('password') }}">
        @error('password')
          <div class="invalid-feedback">username atau password salah</div>
        @enderror
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Masuk Sekarang</button>
      </div>
    </form>

    <div class="text-center mt-3">
      Lupa password? <a href="">Lapor ke Admin</a>
    </div>
  </main>

  <!-- Bootstrap 5 JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
