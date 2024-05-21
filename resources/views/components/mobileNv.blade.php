<header class="header py-2" id="header">
    <nav class="nav container">
        <div class="flex justify-center items-center">
            <img src="{{ asset('assets/logo65.png') }}" alt="" class="w-12">
            <a href="#" class="text-2xl font-semibold">SMKN 65 APP</a>
        </div>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">

                <li class="nav__item sm:translate-y-0 translate-y-5">
                    <a href="{{ url('/siswa/beranda') }}" class="nav__link">
                        <i class='bx bx-book-alt nav__icon'></i>
                        <span class="nav__name">Beranda</span>
                    </a>
                </li>

                <li class="nav__item sm:-translate-y-0 -translate-y-4 sm:text-black sm:bg-transparent sm:border-0 sm:border-transparent sm:rounded-none sm:px-0 sm:py-0 text-white bg-blue-500 border-8 border-white rounded-[70%] px-4 py-3">
                    <a href="#portfolio" class="nav__link">
                        <i class='bx bx-briefcase-alt nav__icon'></i>
                        <span class="nav__name">Absensi</span>
                    </a>
                </li>

                <li class="nav__item sm:translate-y-0 translate-y-5">
                    <a href="#contactme" class="nav__link">
                        <i class='bx bx-message-square-detail nav__icon'></i>
                        <span class="nav__name">Profile</span>
                    </a>
                </li>
            </ul>
        </div>

        <img src="{{ Auth::user()->proPic ? asset('storage/' . Auth::user()->proPic) : asset('assets/img/noProPic.png') }}" alt="" class="nav__img">
    </nav>
</header>
