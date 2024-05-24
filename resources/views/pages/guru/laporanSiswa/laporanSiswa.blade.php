<div id="tabViewLaporanSiswa" class="hidden">
    <div class="mb-8 flex lg:flex-row flex-col lg:justify-between  justify-center lg:items-center items-start">
        <div class="flex flex-wrap justify-start items-center">
            <button data-dropdown-placement="bottom-start"  id="filterLaporan" data-dropdown-toggle="dropdownFilterLaporan" type="button"
            class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded text-sm px-4 py-2 text-center me-2">
            <svg class="h-3.5 w-3.5 mr-1 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            <span id="filterText">
                Filter
            </span>
        </button>
        <!-- Dropdown menu -->
<div id="dropdownFilterLaporan" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="filterLaporan">
      @foreach ($types as $type)
        <li>
            <button onclick="selectType({{ $type->id }}, '{{ $type->tipe }}')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full text-start">{{ $type->tipe }}</button>
        </li>
      @endforeach
    </ul>
    <div class="">
      <button onclick="selectType('', 'Filter')" class="block w-full text-start rounded-b-lg px-4 py-2 text-sm text-white bg-red-500">Reset Filter</button>
    </div>
</div>
        <div>
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input onkeyup="searchLaporan(this.value)" type="search" id="searchLaporan"
                    class="block w-full px-2.5 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari..." required />
            </div>
        </div>
    </div>
    
    <button onclick="getDataLaporan()" type="button"
        class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-green-700 via-green-700 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded text-sm px-4 py-2 text-center me-2">
        <svg class="h-3.5 w-3.5 mr-1 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
        </svg>
        Refresh Data
    </button>
        
    </div>

    <ol id="laporan-siswa-list" class="relative border-s border-gray-200 dark:border-gray-700"></ol>

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


        let filterTipeId = null

        function getDataLaporan() {
            $('#laporan-siswa-list').empty()
            $.ajax({
                url: '/guru/laporan-siswa-ajax',
                method: 'GET',
                success: function(res) {
                    res.data?.forEach((res) => {

                        let laporanPicture = null
                        let isAnonymous = null

                        if (res.gambar) {
                            laporanPicture = `{{ asset('storage/${res.gambar}') }}`
                        }

                        if (res.status == 'Publik') {
                            if (res.siswa.proPic) {
                                isAnonymous = `
                                <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('storage/${res.siswa.proPic}') }}"
                                                        alt="${res.siswa.nama}" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">${res.siswa.nama}</p>
                                                        <button type="button" class="bg-orange-50 text-orange-500 rounded px-1">${res.siswa.role}</button>
                                                    </div>
                                                </div>
                                `
                            } else {
                                isAnonymous = `
                                <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('assets/img/noProPic.png') }}"
                                                        alt="Anonymous" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">${res.siswa.nama}</p>
                                                    </div>
                                                </div>
                                `
                            }
                        } else {
                            isAnonymous = `
                            <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('assets/img/noProPic.png') }}"
                                                        alt="Anonymous" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">Anonim</p>
                                                    </div>
                                                </div
                            `
                        }

                        
                        console.log(res);

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
                                    <img src="${res.gambar ? laporanPicture : ''}" alt="${res.judul}" class="rounded-md w-full max-w-2xl">
                                </div>
                                <div>
                                    <p
                                        class="mt-3 text-base text-gray-800 dark:text-gray-400 flex flex-wrap justify-start items-center gap-1">
                                        <span class="font-semibold">Keterangan:</span>${res.keterangan ? res.keterangan : '-' }</p>
                                </div>
                                ${isAnonymous}
                                
                            </div>
                        </li>
                        `)
                    })
                }
            });
        }

        function selectType(tipeId, tipeName) {
            filterTipeId = tipeId
            console.log(tipeName);
            $('#filterText').text(tipeName)

            searchLaporan($('#searchLaporan').val())
        }

        function searchLaporan(str) {
            $.ajax({
                url: '/guru/laporan-siswa-ajax',
                data: {
                    "search": str,
                    "tipeId": filterTipeId
                },
                method: 'GET',
                success: function(res) {
                    $('#laporan-siswa-list').empty()
                    if (res.data.length > 0) {
                        res.data?.forEach((res) => {

                        let laporanPicture = null
                        let isAnonymous = null

                        if (res.gambar) {
                            laporanPicture = `{{ asset('storage/${res.gambar}') }}`
                        }

                        if (res.status == 'Publik') {
                            if (res.siswa.proPic) {
                                isAnonymous = `
                                <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('storage/${res.siswa.proPic}') }}"
                                                        alt="${res.siswa.nama}" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">${res.siswa.nama}</p>
                                                        <button type="button" class="bg-orange-50 text-orange-500 rounded px-1">${res.siswa.role}</button>
                                                    </div>
                                                </div>
                                `
                            } else {
                                isAnonymous = `
                                <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('assets/img/noProPic.png') }}"
                                                        alt="Anonymous" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">${res.siswa.nama}</p>
                                                    </div>
                                                </div>
                                `
                            }
                        } else {
                            isAnonymous = `
                            <div class="flex items-center space-x-2 mt-3">
                                                    <img class="w-9 h-9 rounded-full"
                                                        src="{{ asset('assets/img/noProPic.png') }}"
                                                        alt="Anonymous" />
                                                    <div class="">
                                                        <p class="font-medium dark:text-white">Anonim</p>
                                                    </div>
                                                </div
                            `
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
                                    <img src="${res.gambar ? laporanPicture : ''}" alt="${res.judul}" class="rounded-md w-full max-w-2xl">
                                </div>
                                <div>
                                    <p
                                        class="mt-3 text-base text-gray-800 dark:text-gray-400 flex flex-wrap justify-start items-center gap-1">
                                        <span class="font-semibold">Keterangan:</span>${res.keterangan ? res.keterangan : '-' }</p>
                                </div>
                                ${isAnonymous}
                                
                            </div>
                        </li>
                        `)
                        })
                    }
                }
            });
        }

        getDataLaporan()
    </script>
</div>
