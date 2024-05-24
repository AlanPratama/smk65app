@extends('layouts.main')

@section('title', 'Laporan Siswa')

@section('content')
    <div class="mb-3 px-4 flex justify-between lg:items-center items-start">
        <button data-drawer-target="create-laporanSiswa" data-drawer-show="create-laporanSiswa"
            aria-controls="create-laporanSiswa" type="button"
            class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded text-sm px-2 py-2 text-center me-2 mb-2">
            Kirim Laporan
        </button>

        <div>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input onkeyup="searchLaporan(this.value)" type="search" id="default-search"
                    class="block w-full px-2.5 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Laporan Kamu..." required />
            </div>
        </div>
    </div>

    <ol id="laporan-siswa-list" class="relative border-s-2 ml-5 border-gray-200 dark:border-gray-700">


    </ol>

    @include('components.siswa.laporanSiswa.createModal')
    @include('components.siswa.laporanSiswa.editModal')
    @include('components.siswa.laporanSiswa.deleteModal')

    <script>
        function convertDate(dateString) {
            // Membuat objek Date dari string tanggal
            const date = new Date(dateString);
            
            // Array hari dan bulan dalam bahasa Indonesia
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];

            // Mendapatkan nama hari, tanggal, nama bulan, dan tahun
            const dayName = days[date.getDay()];
            const day = date.getDate();
            const monthName = months[date.getMonth()];
            const year = date.getFullYear();

            // Mengembalikan string dalam format "Hari, DD MMMM YYYY"
            return `${dayName}, ${day} ${monthName} ${year}`;
        }

        function convertTime(timestamp) {
            var date = new Date(timestamp.replace(' ', 'T'));

            var hours = date.getHours();
            var minutes = date.getMinutes();

            var time = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

            return time;
        }

        $.ajax({
            url: '/siswa/laporan-siswa-ajax',
            method: 'GET',
            success: function(res) {
                res.data?.forEach((res) => {

                    let siswaProPic = null

                    if (res.gambar) {
                        siswaProPic = `{{ asset('storage/${res.gambar}') }}`
                    }

                    $('#laporan-siswa-list').append(`
                    <li class="mb-10 lg:ml-6 ml-1" id="laporan-${res.id}">
                        <span
                            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                        <div class="ml-4 pr-4">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900 dark:text-white">${res.judul} <span
                                    class="${!res.tipe && 'hidden'} bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">${res.tipe && res.tipe.tipe}</span>
                            </h3>
                            <time class="block mb-2 text-sm leading-none text-gray-600 dark:text-gray-500">${convertDate(res.tanggal)} - ${convertTime(res.created_at)} (${res.status})</time>
                            <p class="mb-3 text-justify text-base text-gray-800 dark:text-gray-400">${res.deskripsi}</p>
                            <div
                                class="${res.gambar ? '' : 'hidden'} inline-flex items-center text-sm font-medium text-gray-900 bg-white hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:focus:ring-gray-700">
                                <img src="${res.gambar ? siswaProPic : ''}" alt="${res.judul}" class="rounded-md max-w-full">
                            </div>
                            <div>
                                <p
                                    class="mt-3 text-base text-gray-800 dark:text-gray-400 flex flex-wrap justify-start items-center gap-1">
                                    <span class="font-semibold">Keterangan:</span>${res.keterangan ? res.keterangan : '-' }</p>
                            </div>
                            <div class="flex justify-start items-center mt-3">
                                <button data-id="${res.id}" id="btn-edit-laporanSiswa" type="button"
                                    class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-green-500 to-green-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
                                    Edit
                                </button> 
                                <button data-id="${res.id}" id="btn-delete-laporanSiswa" type="button"
                                    class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-red-500 to-red-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </li>
                    `)
                })
            }
        });


        function searchLaporan(str) {

            $.ajax({
                url: '/siswa/laporan-siswa-ajax',
                method: 'GET',
                data: {
                    "search": str
                },
                success: function(res) {
                    $('#laporan-siswa-list').empty()

                    res.data?.forEach((res) => {

                    let siswaProPic = null

                    if (res.gambar) {
                        siswaProPic = `{{ asset('storage/${res.gambar}') }}`
                    }

                    $('#laporan-siswa-list').append(`
                    <li class="mb-10 lg:ml-6 ml-1" id="laporan-${res.id}">
                        <span
                            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                        <div class="ml-4 pr-4">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900 dark:text-white">${res.judul} <span
                                    class="${!res.tipe && 'hidden'} bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">${res.tipe && res.tipe.tipe}</span>
                            </h3>
                            <time class="block mb-2 text-sm leading-none text-gray-600 dark:text-gray-500">${convertDate(res.tanggal)} - ${convertTime(res.created_at)} (${res.status})</time>
                            <p class="mb-3 text-justify text-base text-gray-800 dark:text-gray-400">${res.deskripsi}</p>
                            <div
                                class="${!res.gambar && 'hidden'} inline-flex items-center text-sm font-medium text-gray-900 bg-white hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:focus:ring-gray-700">
                                <img src="${res.gambar && siswaProPic}" alt="${res.judul}" class="rounded-md max-w-full">
                            </div>
                            <div>
                                <p
                                    class="mt-3 text-base text-gray-800 dark:text-gray-400 flex flex-wrap justify-start items-center gap-1">
                                    <span class="font-semibold">Keterangan:</span>${res.keterangan ? res.keterangan : '-' }</p>
                            </div>
                            <div class="flex justify-start items-center mt-3">
                                <button data-id="${res.id}" id="btn-edit-laporanSiswa" type="button"
                                    class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-green-500 to-green-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
                                    Edit
                                </button> 
                                <button data-id="${res.id}" id="btn-delete-laporanSiswa" type="button"
                                    class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-red-500 to-red-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </li>
                    `)
                    })
                }
            })
        }
    </script>
@endsection
