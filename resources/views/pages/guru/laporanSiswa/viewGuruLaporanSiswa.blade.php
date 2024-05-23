@extends('layouts.guru')

@section('title', 'Pengumuman')

@section('content')


    <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400 cursor-pointer">
            <li id="tabPengumuman"
                class="me-2 inline-flex items-center justify-center p-4 border-b-2">
                <svg class="w-4 h-4 me-2" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path
                        d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>Laporan Siswa
            </li>
            <li id="tabTipe"
                class="me-2 inline-flex items-center justify-center p-4 border-b-2">
                <svg class="w-4 h-4 me-2"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path
                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                </svg>Tipe Laporan
            </li>
        </ul>
    </div>

    @include('pages.guru.laporanSiswa.laporanSiswa')
    @include('pages.guru.laporanSiswa.tipeLaporan')

    <script>
        let isActive = 'rounded-t-lg text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500 group'
        let isNotActive = 'border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group'


        // $('#tabPengumuman').addClass(isActive)
        // $('#tabTipe').addClass(isNotActive)
        $('#tabPengumuman').addClass(isNotActive)
        $('#tabTipe').addClass(isActive)

        // $('#tabPengumuman').addClass(isNotActive)
        // $('#tabTipe').addClass(isActive)

        // PENGUMUMAN TAB IS ACTIVE
        $('body').on('click', '#tabPengumuman', function() {
            $('#tabViewLaporanSiswa').removeClass('hidden')
            $('#tabPengumuman').addClass(isActive)
            $('#tabPengumuman').removeClass(isNotActive)
            
            $('#tabViewTipeLaporan').addClass('hidden')
            $('#tabTipe').removeClass(isActive)
            $('#tabTipe').addClass(isNotActive)
        })

        // TIPE TAB IS ACTIVE
        $('body').on('click', '#tabTipe', function() {
            $('#tabViewTipeLaporan').removeClass('hidden')
            $('#tabTipe').addClass(isActive)
            $('#tabTipe').removeClass(isNotActive)

            $('#tabViewLaporanSiswa').addClass('hidden')
            $('#tabPengumuman').removeClass(isActive)
            $('#tabPengumuman').addClass(isNotActive)
        })
    </script>
@endsection
