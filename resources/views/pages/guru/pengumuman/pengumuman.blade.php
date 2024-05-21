<div id="tabViewPengumuman" class="">
    <div class="mb-3 flex lg:flex-row flex-col lg:justify-between  justify-center lg:items-center items-start">
        <div class="flex flex-wrap justify-start items-center">
            <button data-drawer-target="create-pengumuman" data-drawer-show="create-pengumuman" aria-controls="create-pengumuman" type="button"
            class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
            <svg class="h-3.5 w-3.5 mr-1 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Tambah Pengumuman
        </button>
        <button onclick="getDataPengumuman()" type="button"
            class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-green-700 via-green-700 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded text-sm px-4 py-2 text-center me-2 mb-2">
            <svg class="h-3.5 w-3.5 mr-1 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Refresh Data
        </button>
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
                <input onkeyup="searchPengumuman(this.value)" type="search" id="default-search"
                    class="block w-full px-2.5 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari..." required />
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{-- <th scope="col" class="px-6 py-3">
                        No.
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guru
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="table-pengumuman">
                
            </tbody>
            
        </table>
            {{-- <div class="min-h-screen bg-blue-50">

                <ul class="pagination">
                    <li class="page-item {{ ($pengumuman->currentPage() == 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $pengumuman->url(1) }}">First</a>
                    </li>
                    <li class="page-item {{ ($pengumuman->currentPage() == 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $pengumuman->previousPageUrl() }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $pengumuman->lastPage(); $i++)
                        <li class="page-item {{ ($pengumuman->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $pengumuman->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ ($pengumuman->currentPage() == $pengumuman->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $pengumuman->nextPageUrl() }}">Next</a>
                    </li>
                    <li class="page-item {{ ($pengumuman->currentPage() == $pengumuman->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $pengumuman->url($pengumuman->lastPage()) }}">Last</a>
                    </li>
                </ul>
            </div> --}}
    </div>

    @include('components.guru.viewGuruPengumuman.pengumuman.createModal')
    @include('components.guru.viewGuruPengumuman.pengumuman.editModal')
    @include('components.guru.viewGuruPengumuman.pengumuman.deleteModal')
    @include('components.guru.viewGuruPengumuman.pengumuman.detailModal')

    <script>
        function convertDate(dateString) {
            // Membuat objek Date dari string tanggal
            const date = new Date(dateString);
            console.log(date);
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

        function getDataPengumuman() {
            $.ajax({
                url: '/pengumumanAjax',
                method: 'GET',
                success: function(res) {

                    $('#table-pengumuman').empty()
                    console.log(res.data.data);

                    if (res.data.length > 0) {
                        res.data.forEach(res => {
                            let table = `
                                <tr id="pengumuman-${res.id}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ${res.judul}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${res.guru.nama}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-50 text-blue-500 py-0.5 px-1 rounded">${res.tipe ? res.tipe.tipe : '-'}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        ${convertDate(res.tanggal)}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <button id="btn-edit-pengumuman" data-id="${res.id}" type="button"
                                                class="py-2 px-2 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewbox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button id="btn-detail-pengumuman" data-id="${res.id}" type="button" aria-controls="drawer-read-product-advanced"
                                                class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                                    class="w-4 h-4">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                </svg>
                                            </button>
                                            <button id="btn-delete-pengumuman" type="button" data-id="${res.id}"
                                                class="flex items-center text-white bg-red-500 focus:ring-4 focus:outline-none hover:bg-red-600 focus:ring-red-300 font-medium rounded text-sm px-2 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewbox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- Delete Modal -->
                                    <div id="delete-modal-${res.id}" tabindex="-1"
                                        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full h-auto max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                    data-modal-toggle="delete-modal-${res.id}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg aria-hidden="true"
                                                        class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                                                        stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                                        you
                                                        want to delete
                                                        this ${res.judul}?</h3>
                                                    <button id="delete-pengumuman" data-id=${res.id}
                                                        data-modal-toggle="delete-modal-${res.id}" type="button"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Yes,
                                                        I'm sure</button>
                                                    <button data-modal-toggle="delete-modal-${res.id}" type="button"
                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                        cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            `

                            $('#table-pengumuman').append(table)
                        })
                    } else {
                        let table = `
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    
                                    <td colspan="5" rowspan="5" class="text-center px-6 py-4">
                                        DATA TIDAK DITEMUKAN!
                                    </td>
                                </tr>
                            `

                        $('#table-pengumuman').append(table)
                    }

                }
            })
        }
        getDataPengumuman()

        function searchPengumuman(str) {
            console.log(str);
            $.ajax({
                url: '/pengumumanAjax',
                method: 'GET',
                data: {
                    search: str
                },
                success: function(res) {

                    $('#table-pengumuman').empty()
                    console.log(res);

                    if (res.data.length > 0) {
                        res.data.forEach(res => {
                            let table = `
                                <tr id="pengumuman-${res.id}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ${res.judul}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${res.guru.nama}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-50 text-blue-500 py-0.5 px-1 rounded">${res.tipe ? res.tipe.tipe : '-'}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        ${convertDate(res.tanggal)}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <button id="btn-edit-pengumuman" data-id="${res.id}" type="button"
                                                class="py-2 px-2 flex items-center text-sm font-medium text-center text-white bg-blue-700 rounded hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewbox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button id="btn-detail-pengumuman" data-id="${res.id}" type="button" aria-controls="drawer-read-product-advanced"
                                                class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                                    class="w-4 h-4">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                </svg>
                                            </button>
                                            <button id="btn-delete-pengumuman" type="button" data-id="${res.id}"
                                                class="flex items-center text-white bg-red-500 focus:ring-4 focus:outline-none hover:bg-red-600 focus:ring-red-300 font-medium rounded text-sm px-2 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewbox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- Delete Modal -->
                                    <div id="delete-modal-${res.id}" tabindex="-1"
                                        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full h-auto max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                    data-modal-toggle="delete-modal-${res.id}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg aria-hidden="true"
                                                        class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                                                        stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                                        you
                                                        want to delete
                                                        this ${res.judul}?</h3>
                                                    <button id="delete-pengumuman" data-id=${res.id}
                                                        data-modal-toggle="delete-modal-${res.id}" type="button"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Yes,
                                                        I'm sure</button>
                                                    <button data-modal-toggle="delete-modal-${res.id}" type="button"
                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                        cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            `

                            $('#table-pengumuman').append(table)
                        })
                    } else {
                        let table = `
                                <tr id="pengumuman-${res.data.id}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    
                                    <td colspan="5" rowspan="5" class="text-center px-6 py-4">
                                        DATA TIDAK DITEMUKAN!
                                    </td>
                                </tr>
                            `

                        $('#table-pengumuman').append(table)
                    }

                }
            })
        }
    </script>

</div>
