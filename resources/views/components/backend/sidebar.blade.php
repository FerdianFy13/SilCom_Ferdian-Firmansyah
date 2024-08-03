<div class="sidebar sidebar-style-2" data-background-color="white">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="white">
            <a href="index.html" class="logo d-flex align-items-center fs-2 fw-bold">
                <img src="{{ asset('dist/img/kaiadmin/favicon.svg') }}" alt="navbar brand" class="navbar-brand me-2"
                    height="70" /> SilCom
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

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            @php
                $navItems = config('menu.items');
            @endphp

            <ul class="nav nav-secondary">
                @foreach ($navItems as $item)
                    @if (isset($item['section']) && $item['section'])
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <h4 class="text-section">{{ $item['text'] }}</h4>
                        </li>
                    @else
                        <li class="nav-item {{ Request::is($item['route'] . '*') ? 'active' : '' }}">
                            <a href="{{ url($item['route']) }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <p>{{ $item['text'] }}</p>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
