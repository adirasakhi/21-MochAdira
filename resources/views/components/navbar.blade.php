<nav class="navbar bg-base-100 shadow-md">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="/" class="btn btn-ghost btn-block">Beranda</a></li>
                <li><a href="/#about-us" class="btn btn-ghost btn-block">About</a></li>
                <li><a href="/#car-services" class="btn btn-ghost btn-block">Superiority</a></li>
                <li><a href="/#google-maps" class="btn btn-ghost btn-block">Lokasi</a></li>
                <li><a href="/cars" class="btn btn-ghost btn-block">Daftar Mobil</a></li>
                @guest
                    <li><a href="/login" class="btn btn-outline btn-ghost btn-block">Sign-in</a></li>
                    <li><a href="/register" class="btn btn-outline btn-ghost btn-block">Sign-up</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('profile.show') }}" class="btn btn-ghost btn-block">Profile</a></li>
                    <li>
                        @if (auth()->user()->role_id == 1)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-block">Dashboard Admin</a>
                        @else
                            <a href="{{ route('rentals.index') }}" class="btn btn-ghost btn-block">My Rentals</a>
                        @endif
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-ghost btn-block">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
        <a href="/" class="btn btn-ghost normal-case text-xl flex items-center">
            <img src="{{ asset('asset/images/logo.png') }}" alt="CarsXRent Logo" class="w-10 h-10 mr-2">
            CarsXRent
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/" class="btn btn-ghost">Beranda</a></li>
            <li><a href="/#about-us" class="btn btn-ghost">About</a></li>
            <li><a href="/#car-services" class="btn btn-ghost">Superiority</a></li>
            <li><a href="/#google-maps" class="btn btn-ghost">Lokasi</a></li>
            <li><a href="/cars" class="btn btn-ghost">Daftar Mobil</a></li>
        </ul>
    </div>
    <div class="navbar-end hidden lg:flex">
        @guest
            <a href="/login" class="btn btn-outline btn-primary rounded-r-lg">Sign-in</a>
            <a href="/register" class="btn btn-primary rounded-l-lg">Sign-up</a>
        @endguest
        @auth
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="User Avatar">
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('profile.show') }}" class="btn btn-ghost">Profile</a></li>
                    <li>
                        @if (auth()->user()->role_id == 1)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Dashboard Admin</a>
                        @else
                            <a href="{{ route('rentals.index') }}" class="btn btn-ghost">My Rentals</a>
                        @endif
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>
