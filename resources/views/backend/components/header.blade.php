      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none">
          <div class="container-xl">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                  aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('home') }}" class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" width="45" height="40" alt="Tabler" class="me-2">
                    <span class="fw-bold fs-5">Kelurahan Subang Jaya</span>
                </a>
            </h1>

              <div class="navbar-nav flex-row order-md-last">
                  <div class="d-md-flex pt-1 pe-2">
                      <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                          data-bs-toggle="tooltip" data-bs-placement="bottom">
                          <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path
                                  d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                          </svg>
                      </a>
                      <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                          data-bs-toggle="tooltip" data-bs-placement="bottom">
                          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                              viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                              <path
                                  d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                          </svg>
                      </a>

                  </div>
                  <div class="nav-item dropdown">

                      @if (Auth::check())
                          <!-- Memeriksa apakah pengguna sudah login -->
                          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                              aria-label="Open user menu">
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" /></svg>
                              <div class="d-none d-xl-block ps-2">
                                  <div>Hello : {{ Auth::user()->name }}</div> <!-- Menampilkan nama pengguna -->
                                  <div class="mt-1 small text-secondary">{{ Auth::user()->role }}</div>
                                  <!-- Menampilkan role pengguna -->
                              </div>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <a href="{{ route('logout') }}" class="dropdown-item"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      @else
                          <a href="{{ route('login') }}" class="nav-link text-reset">Login</a>
                          <!-- Link untuk login jika pengguna belum login -->
                      @endif

                  </div>

              </div>
          </div>
      </header>
      <header class="navbar-expand-md">
          <div class="collapse navbar-collapse" id="navbar-menu">
              <div class="navbar">
                  <div class="container-xl">
                      <ul class="navbar-nav">
                          <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                              <a class="nav-link " href="{{ route('/dashboard') }}">
                                  <span
                                      class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                          fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                          <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                          <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                      </svg>
                                  </span>
                                  <span class="nav-link-title">
                                      Beranda
                                  </span>
                              </a>
                          </li>
                          @role('Admin')
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#layanan" data-bs-toggle="dropdown"
                                      data-bs-auto-close="outside" role="button" aria-expanded="false">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                              fill="none" stroke-linecap="round" stroke-linejoin="round">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                              <path
                                                  d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                              <path
                                                  d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                              <path
                                                  d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                              <path
                                                  d="M14 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                          </svg>
                                      </span>
                                      <span class="nav-link-title">
                                          Layanan
                                      </span>
                                  </a>
                                  <div class="dropdown-menu">
                                      <div class="dropdown-menu-columns">
                                          <div class="dropdown-menu-column">
                                              <a class="dropdown-item" href="{{route('surat_pengantar_ijin_keramaian.index')}}">
                                                Surat Pengantar Ijin Keramaian                                               </a>
                                              <a class="dropdown-item" href="{{route('surat_keterangan_tidak_mampu.index')}}">
                                                  Surat Keterangan Tidak Mampu
                                              </a>
                                               <a class="dropdown-item" href="{{route('surat_keterangan_miskin.index')}}">
                                                  Surat Keterangan Miskin
                                              </a>
                                                <a class="dropdown-item" href="{{route('surat-pindah-perusahaan.index')}}">
                                                  Surat Pindah Perusahaan / Yayasan
                                              </a>
                                              <a class="dropdown-item" href="{{route('beda-data-kependudukan.index')}}">
                                                  Surat Keterangan Beda Data Kependudukan
                                              </a>
                                          </div>

                                          <div class="dropdown-menu-column">
                                              <a class="dropdown-item" href="{{route('surat-bekerja-luar-negeri.index')}}">
                                                  Surat Keterangan Bekerja di Luar Negeri
                                              </a>
                                               <a class="dropdown-item" href="{{route('surat_keterangan_usahas.index')}}">
                                                  Surat Keterangan Usaha
                                              </a>

                                              <a class="dropdown-item" href="{{route('keterangan_akta_nikah.index')}}">
                                                  Surat Keterangan Status Nikah
                                              </a>
                                                <a class="dropdown-item" href="{{route('surat_keterangan_kematian.index')}}">
                                                  Surat Keterangan Kematian
                                                </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>

                              <li class="nav-item {{ request()->routeIs('artikel') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('artikel.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-article"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M7 8h10" /><path d="M7 12h10" /><path d="M7 16h10" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Artikel
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('saran') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('saran.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h6" /><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Saran Dan Masukan
                                        </span>
                                    </a>
                                </li>
                            <li class="nav-item dropdown {{ request()->is('penduduk*') || request()->is('sektor-pekerjaan*') || request()->is('pekerjaan*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Icon untuk menu profil -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M6 20h12" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Profil
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('penduduk.index') }}">Penduduk</a>
                                    <a class="dropdown-item" href="{{ route('sektor-pekerjaan.index') }}">Sektor Pekerjaan</a>
                                    <a class="dropdown-item" href="{{ route('pekerjaan.index') }}">Pekerjaan</a>
                                </div>
                            </li>
                            <li class="nav-item {{ request()->routeIs('rekap') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('rekap') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M17 17v4h-10v-4"/>
                                            <path d="M5 17v-10a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v10"/>
                                            <path d="M9 11l2 2l4 -4"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">Laporan</span>
                                </a>
                            </li>

                          @endrole
                          @role('User')
                              <li class="nav-item {{ request()->routeIs('surat-saya') ? 'active' : '' }}">
                                  <a class="nav-link " href="{{ route('surat.saya') }}">
                                      <span
                                          class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M15 19l2 2l4 -4" /></svg>
                                      </span>
                                      <span class="nav-link-title">
                                          Surat Saya
                                      </span>
                                  </a>
                              </li>
                          @endrole
                      </ul>
                  </div>
              </div>
          </div>
      </header>
