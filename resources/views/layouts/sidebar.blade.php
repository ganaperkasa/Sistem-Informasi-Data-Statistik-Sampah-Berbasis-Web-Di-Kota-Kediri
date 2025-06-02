<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="" class="app-brand-link">
        <span class="app-brand-logo demo">

        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item {{ \Request::is('/*') ? 'active' : '' }}">
        <a href="/dashboard" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <!-- Layouts -->


      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
      </li>
      <li class="menu-item {{ \Request::is('data-tps*') ? 'active' : '' }}">
        <a href="{{ url('/data-tps') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Data TPS</div>
        </a>
      </li>
      <li class="menu-item {{ Request::is('waste-entries*') || Request::is('waste-outflows*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Pengelolaan Sampah</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('waste-entries') ? 'active' : '' }}">
            <a href="/waste-entries" class="menu-link">
              <div data-i18n="Account">Sampah Masuk</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('waste-outflows') ? 'active' : '' }}">
            <a href="/waste-outflows" class="menu-link">
              <div data-i18n="Notifications">Sampah Keluar</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ \Request::is('reduksi-sampah*') ? 'active' : '' }}">
        <a href="{{ url('/reduksi-sampah') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Reduksi Sampah</div>
        </a>
      </li>

      <li class="menu-item {{ Request::is('maps*') || Request::is('maps-tps*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Pengaturan Maps</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('maps') ? 'active' : '' }}">
            <a href="/maps" class="menu-link">
              <div data-i18n="Account">Tambah TPS</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('maps-tps') ? 'active' : '' }}">
            <a href="/maps-tps" class="menu-link">
              <div data-i18n="Notifications">Lihat TPS</div>
            </a>
          </li>
        </ul>
      </li>

      {{-- <li class="menu-item active">
        <a href="/maps" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Tambah TPS</div>
        </a>
      </li>
      <li class="menu-item active">
        <a href="/maps-tps" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Lihat TPS</div>
        </a>
      </li> --}}



      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">User</span></li>
      <!-- Cards -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Account Settings</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="pages-account-settings-account.html" class="menu-link">
              <div data-i18n="Account">Account</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="pages-account-settings-notifications.html" class="menu-link">
              <div data-i18n="Notifications">Notifications</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="pages-account-settings-connections.html" class="menu-link">
              <div data-i18n="Connections">Connections</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- User interface -->


    </ul>
  </aside>