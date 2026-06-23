<aside class="app-sidebar bg-success-subtle shadow" data-bs-theme="dark">
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
      <span class="brand-text fw-light">Cemilin</span>
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
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation"
      >
        <li class="nav-item">
          <a href="{{ route('siswa.beranda') }}" class="nav-link {{ request()->routeIs('siswa.beranda') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>

        <li class="nav-item {{ request()->routeIs('siswa.produk.kategori') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Kategori
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

          <ul class="nav nav-treeview">
            @foreach ($kategori as $kategoris)
              <li class="nav-item">
                @php
                  $isActiveCategory = request()->routeIs('siswa.produk.kategori') && (int) request()->route('id') === (int) $kategoris->id;
                @endphp
                <a href="{{ route('siswa.produk.kategori', $kategoris->id) }}" class="nav-link {{ $isActiveCategory ? 'active' : '' }}">
                  <i class="nav-icon bi bi-bookmarks"></i>
                  <p>
                    {{ $kategoris->kategori }}
                  </p>
                </a>
              </li>
            @endforeach
          </ul>
        </li>

        <li class="nav-item {{ request()->routeIs('siswa.produk.kantin') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Kantin
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

          <ul class="nav nav-treeview">
            @foreach ($kantin as $kantins)
              <li class="nav-item">
                @php
                  $isActiveCategory = request()->routeIs('siswa.produk.kantin') && (int) request()->route('id') === (int) $kantins->id;
                @endphp
                <a href="{{ route('siswa.produk.kantin', $kantins->id) }}" class="nav-link {{ $isActiveCategory ? 'active' : '' }}">
                  <i class="nav-icon bi bi-bookmarks"></i>
                  <p>
                    {{ $kantins->nama_kantin }}
                  </p>
                </a>
              </li>
            @endforeach
          </ul>
        </li>

      </ul>
      <!--end::Sidebar Menu-->

    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>