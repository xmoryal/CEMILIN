<aside class="app-sidebar bg-primary-subtle shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="#" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">Admin Kantin</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        id="navigation"
      >
        <li class="nav-item">
          <a href="{{ route('admin.beranda') }}" class="nav-link {{ request()->routeIs('admin.beranda*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.kantin.index') }}" class="nav-link {{ request()->routeIs('admin.kantin*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-bookmarks"></i>
            <p>
              Kantin
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.siswa.index') }}" class="nav-link {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-bookmarks"></i>
            <p>
              Siswa
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.kategori.list') }}" class="nav-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-bookmarks"></i>
            <p>
              Kategori
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-bookmarks"></i>
            <p>
              Produk
            </p>
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>