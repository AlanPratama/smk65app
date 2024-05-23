<div id="tabViewTipeLaporan" class="">
    <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30 hidden" id="backdrop-effect-tipe"></div>

    <div class="mb-3 flex lg:flex-row flex-col lg:justify-between  justify-center items-start">

        <div class="flex flex-wrap justify-start items-center mb-2">
            <div>
                <form id="createTipeForm" class="flex justify-start items-center ">
                    <label for="create-tipe-pengumuman"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="tipe" id="create-tipe-pengumuman"
                            class="block w-full px-2.5 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-l-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan Tipe Pengumuman..." required />
                    </div>
                    <button type="submit"
                        class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-r-lg text-sm px-4 py-2 text-center me-2">
                        Submit
                    </button>
                </form>
                <p class="text-red-500 font-semibold" id="createTipeError"></p>
            </div>
            <button onclick="getDataTipe()" type="button"
                class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-green-700 via-green-700 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded text-sm px-4 py-2 text-center me-2">
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
                <input onkeyup="searchTipe(this.value)" type="search" id=""
                    class="block w-full px-2.5 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Tipe Pengumuman..." required />
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
                        Tipe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Laporan Count
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="table-tipe">
            </tbody>
        </table>
    </div>

    @include('components.guru.viewGuruLaporanSiswa.tipeLaporan.editModal')
@include('components.guru.viewGuruLaporanSiswa.tipeLaporan.deleteModal')

    <script>
        function searchTipe(str) {
            console.log(str);
            $.ajax({
                url: '/guru/tipe-laporan-ajax',
                method: 'GET',
                data: {
                    search: str
                },
                success: function(res) {
                    $('#table-tipe').empty()
    
                    if (res.data.length > 0) {
                        res.data.forEach(res => {
                            $('#table-tipe').append(`
                        <tr id="table-tipe-${res.id}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${res.tipe}
                            </th>
                            <td class="px-6 py-4">
                                ${res.laporan.length}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <button id="btn-edit-tipe"
                                        data-id="${res.id}" type="button"
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
                                    <button id="btn-detail-tipe" data-id="${res.id}" type="button"
                                        aria-controls="drawer-read-product-advanced"
                                        class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                        </svg>
                                    </button>
                                    <button id="btn-delete-tipe" type="button" data-id="${res.id}"
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
    
    
                        </tr>
                    `)
                        })
                    } else {
                        $('#table-tipe').append(`
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-center">
                                TIDAK ADA DATA DITEMUKAN
                            </td>
                        </tr>
                    `)
                    }
                }
            })
        }
    
    
        function getDataTipe() {
            $.ajax({
            type: 'GET',
            url: '/guru/tipe-laporan-ajax',
            success: function(res) {
                console.log(res);
                $('#table-tipe').empty();
                if (res.data.length > 0) {
                    res.data.forEach(res => {
                    $('#table-tipe').append(`
                        <tr id="table-tipe-${res.id}"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${res.tipe}
                            </th>
                            <td class="px-6 py-4">
                                ${res.laporan.length}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <button id="btn-edit-tipe"
                                        data-id="${res.id}" type="button"
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
                                    <button id="btn-detail-tipe" data-id="${res.id}" type="button"
                                        aria-controls="drawer-read-product-advanced"
                                        class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                        </svg>
                                    </button>
                                    <button id="btn-delete-tipe" type="button" data-id="${res.id}"
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
    
    
                        </tr>
                    `)
                })  
                } else {
                    $('#table-tipe').append(`
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="3" class="px-6 py-4 text-center">
                                TIDAK ADA DATA DITEMUKAN
                            </td>
                        </tr>
                    `)
                }
            }
        })
        }
    
        getDataTipe()
    
    
    
        $(document).ready(function() {
            $('#createTipeForm').on('submit', function(e) {
                e.preventDefault()
    
                $.ajax({
                    type: 'POST',
                    url: "/tipe-pengumuman",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.statusCode == 200) {
                            console.log(res);
                            $('#createTipeForm')[0].reset()
                            $('#createTipeError').empty()
    
                            $('#table-tipe').prepend(`
                                <tr id="table-tipe-${res.data.id}"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        ${res.data.tipe}
                                    </th>
                                    <td class="px-6 py-4">
                                        ${res.data.laporan.length}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <button id="btn-edit-tipe"
                                                data-id="${res.data.id}" type="button"
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
                                            <button id="btn-detail-pengumuman" data-id="${res.data.id}" type="button"
                                                aria-controls="drawer-read-product-advanced"
                                                class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                                    class="w-4 h-4">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                </svg>
                                            </button>
                                            <button id="btn-delete-pengumuman" type="button" data-id="${res.data.id}"
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
    
    
                                </tr>
                            `)
    
                        }
    
                    },
                    error: function(err) {
                        console.log(err.responseJSON.errors.tipe[0]);
                        $('#createTipeError').html(`* ${err.responseJSON.errors.tipe[0]}`)
                    }
                })
            })
        })
    
    </script>
</div>



