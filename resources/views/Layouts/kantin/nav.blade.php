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
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
    
      <!--end::Fullscreen Toggle-->
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          @if(!empty(Auth::guard('kantin')->User()->foto) && file_exists(public_path('assets/img/profile/' . Auth::guard('kantin')->User()->foto)))
              <img src="{{ asset('assets/img/profile/' . Auth::guard('kantin')->User()->foto) }}" class="user-image rounded-circle shadow"
            alt="User Image">
            @else
              <img
              src="{{ asset('assets/img/profile/toko.jpeg') }}"
              class="user-image rounded-circle shadow"
              alt="User Image"
            />
            @endif
          <span class="d-none d-md-inline">{{ Auth::guard('kantin')->User()->nama_kantin }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <!--begin::User Image-->
          <li class="user-header text-bg-primary">
            @if(!empty(Auth::guard('kantin')->User()->foto) && file_exists(public_path('assets/img/profile/' . Auth::guard('kantin')->User()->foto)))
              <img src="{{ asset('assets/img/profile/' . Auth::guard('kantin')->User()->foto) }}" class="rounded-circle shadow"
              alt="User Image">
            @else
              <img
              src="{{ asset('assets/img/profile/toko.jpeg') }}"
              class="rounded-circle shadow"
              alt="User Image"
            />
            @endif
            <p>
              {{ Auth::guard('kantin')->User()->nama_kantin }}
            </p>
            <p>
              {{ Auth::guard('kantin')->User()->email }}
            </p>
          </li>
          <!--end::User Image-->
          <!--begin::Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('penjual.profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline float-end">
            @csrf
            <button type="submit" class="btn btn-default btn-flat" onclick="return confirm('Yakin mau keluar?')">Sign out</button>
            </form>
          </li>
          <!--end::Menu Footer-->
        </ul>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>