<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0"><i class="fa fa-car text-primary me-2"></i>SilCom</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/courses') }}"
                class="nav-item nav-link {{ request()->is('courses*') ? 'active' : '' }}">Courses</a>
            <a href="{{ url('/contact') }}"
                class="nav-item nav-link {{ request()->is('contact*') ? 'active' : '' }}">Contact</a>

            {{-- login check --}}
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp

                @if ($user->hasRole('Admin'))
                    <a href="{{ url('/dashboard') }}" class="nav-item nav-link">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                    </a>
                    <span class="nav-item nav-link">Hello, {{ $user->name }}</span>
                @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user me-2"></i>{{ $user->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ url('/logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endif

                <a href="{{ url('/order-payment') }}"
                    class="nav-item nav-link {{ request()->is('order-payment*') ? 'active' : '' }}"><i
                        class="fa fa-shopping-cart"></i></a>
            @else
                <a href="{{ url('/login') }}" class="nav-item nav-link">
                    <i class="fa fa-sign-in-alt"></i> Login
                </a>
            @endif
            {{-- end login check --}}

        </div>
    </div>
</nav>
