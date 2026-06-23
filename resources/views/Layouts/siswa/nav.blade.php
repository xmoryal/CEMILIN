<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->
    <ul class="navbar-nav ms-auto">

      {{-- keranjang --}}
      <div class="d-flex align-items-center" data-bs-toggle="offcanvas"  data-bs-target="#cartCanvas">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3 me-2" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .49.598l-1.5 7A.5.5 0 0 1 13 13H4a.5.5 0 0 1-.49-.402L1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <span class="badge bg-danger rounded-pill ms-1">{{ $hitungproduk }}</span>
      </div>
    </ul>
    
    <ul class="navbar-nav ms-1">
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          @if(!empty(Auth::guard('siswa')->User()->foto) && file_exists(public_path('assets/img/profile/' . Auth::guard('siswa')->User()->foto)))
              <img src="{{ asset('assets/img/profile/' . Auth::guard('siswa')->User()->foto) }}" class="user-image shadow"
            alt="User Image">
            @else
              <img
              src="{{ asset('assets/img/profile/siswa.png') }}"
              class="user-image rounded-circle shadow"
              alt="User Image"
            />
            @endif
          <span class="d-none d-md-inline">{{ Auth::guard('siswa')->User()->nama_siswa }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <!--begin::User Image-->
          <li class="user-header text-bg-success">
            @if(!empty(Auth::guard('siswa')->User()->foto) && file_exists(public_path('assets/img/profile/' . Auth::guard('siswa')->User()->foto)))
              <img src="{{ asset('assets/img/profile/' . Auth::guard('siswa')->User()->foto) }}" class="rounded-circle shadow"
              alt="User Image">
            @else
              <img
              src="{{ asset('assets/img/profile/siswa.png') }}"
              class="rounded-circle shadow"
              alt="User Image"
            />
            @endif
            <p>
              {{ Auth::guard('siswa')->User()->nama }}
            </p>
            <p>
              {{ Auth::guard('siswa')->User()->username }}
            </p>
          </li>
          <!--end::User Image-->
          <!--begin::Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('siswa.profile') }}" class="btn btn-warning btn-flat">Edit Profile</a>
            <form action="{{ route('siswa.logout') }}" method="POST" class="d-inline float-end">
            @csrf
            <button type="submit" class="btn btn-danger btn-flat" onclick="return confirm('Yakin mau keluar?')">Sign out</button>
            </form>
          </li>
          <!--end::Menu Footer-->
        </ul>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
  </div>
  <!--end::Container-->
</nav>