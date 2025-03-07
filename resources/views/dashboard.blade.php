@extends('backend.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        Kelurahan Subang Jaya
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl mt-5">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Pendaftaran</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Filter</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">7 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">30 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">3 Bulan Terakhir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3">2</div>
                        <small>Hari Ini</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Proses</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Filter</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">7 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">30 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">3 Bulan Terakhir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3">10</div>
                        <small>Hari Ini</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Selesai</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Filter</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">7 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">30 Hari Terakhir</a>
                                        <a class="dropdown-item" href="#">3 Bulan Terakhir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3">10</div>
                        <small>Hari Ini</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">

            <div class="col-md-6">
                <h1>Pendaftaran</h1>
                <div class="card" style="height: 28rem">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">JL</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Jeffie Lewzey</strong> commented on your <strong>"I'm not a
                                                witch."</strong> post.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/002m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            It's <strong>Mallory Hulme</strong>'s birthday. Wish him well!
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/003m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Dunn Slane</strong> posted <strong>"Well, what do you want?"</strong>.
                                        </div>
                                        <div class="text-secondary">today</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/000f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Emmy Levet</strong> created a new project <strong>Morning alarm
                                                clock</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/001f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Maryjo Lebarree</strong> liked your photo.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">EP</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Egan Poetz</strong> registered new client as <strong>Trilia</strong>.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/002f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Kellie Skingley</strong> closed a new deal on project <strong>Pen
                                                Pineapple Apple Pen</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/003f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Christabel Charlwood</strong> created a new project for
                                            <strong>Wikibox</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">HS</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Haskel Shelper</strong> change status of <strong>Tabler Icons</strong>
                                            from <strong>open</strong> to <strong>closed</strong>.
                                        </div>
                                        <div class="text-secondary">today</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/006m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Lorry Mion</strong> liked <strong>Tabler UI Kit</strong>.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/004f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Leesa Beaty</strong> posted new video.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/007m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Perren Keemar</strong> and 3 others followed you.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">SA</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Sunny Airey</strong> upload 3 new photos to category
                                            <strong>Inspirations</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/009m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Geoffry Flaunders</strong> made a <strong>$10</strong> donation.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/010m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Thatcher Keel</strong> created a profile.
                                        </div>
                                        <div class="text-secondary">3 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/005f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Dyann Escala</strong> hosted the event <strong>Tabler UI
                                                Birthday</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/006f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Avivah Mugleston</strong> mentioned you on <strong>Best of
                                                2020</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">AA</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Arlie Armstead</strong> sent a Review Request to <strong>Amanda
                                                Blake</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <h1>Proses</h1>
                <div class="card" style="height: 28rem">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">JL</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Jeffie Lewzey</strong> commented on your <strong>"I'm not a
                                                witch."</strong> post.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/002m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            It's <strong>Mallory Hulme</strong>'s birthday. Wish him well!
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/003m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Dunn Slane</strong> posted <strong>"Well, what do you want?"</strong>.
                                        </div>
                                        <div class="text-secondary">today</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/000f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Emmy Levet</strong> created a new project <strong>Morning alarm
                                                clock</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/001f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Maryjo Lebarree</strong> liked your photo.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">EP</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Egan Poetz</strong> registered new client as <strong>Trilia</strong>.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/002f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Kellie Skingley</strong> closed a new deal on project <strong>Pen
                                                Pineapple Apple Pen</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/003f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Christabel Charlwood</strong> created a new project for
                                            <strong>Wikibox</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">HS</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Haskel Shelper</strong> change status of <strong>Tabler Icons</strong>
                                            from <strong>open</strong> to <strong>closed</strong>.
                                        </div>
                                        <div class="text-secondary">today</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/006m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Lorry Mion</strong> liked <strong>Tabler UI Kit</strong>.
                                        </div>
                                        <div class="text-secondary">yesterday</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/004f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Leesa Beaty</strong> posted new video.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/007m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Perren Keemar</strong> and 3 others followed you.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">SA</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Sunny Airey</strong> upload 3 new photos to category
                                            <strong>Inspirations</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/009m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Geoffry Flaunders</strong> made a <strong>$10</strong> donation.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/010m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Thatcher Keel</strong> created a profile.
                                        </div>
                                        <div class="text-secondary">3 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/005f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Dyann Escala</strong> hosted the event <strong>Tabler UI
                                                Birthday</strong>.
                                        </div>
                                        <div class="text-secondary">4 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url(./static/avatars/006f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Avivah Mugleston</strong> mentioned you on <strong>Best of
                                                2020</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar">AA</span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <strong>Arlie Armstead</strong> sent a Review Request to <strong>Amanda
                                                Blake</strong>.
                                        </div>
                                        <div class="text-secondary">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Jumlah Penduduk</h3>
                    <div id="chart-mentions" class="chart-lg"></div>
                  </div>
                </div>
              </div>
        </div>
    </div>

    </div>
@endsection
