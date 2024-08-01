<div class="main-header">
    <div class="main-header-logo">
        <div class="logo-header" data-background-color="white">
            <a href="index.html" class="logo d-flex align-items-center fs-2 fw-bold">
                <img src="{{ asset('dist/img/kaiadmin/favicon.svg') }}" alt="navbar brand" class="navbar-brand me-2"
                    height="20" /> SilCom
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <div class="hstack gap-3">
                    <li class="nav-item">
                        <span class="fw-bold"><i
                                class="fas fa-user-cog me-3"></i>{{ auth()->user()->getRoleNames()->implode(',') }}</span>
                    </li>
                    <div class="vr"></div>
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                            aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="dist/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hi,</span>
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            <img src="dist/img/profile.jpg" alt="image profile"
                                                class="avatar-img rounded" />
                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
</div>
