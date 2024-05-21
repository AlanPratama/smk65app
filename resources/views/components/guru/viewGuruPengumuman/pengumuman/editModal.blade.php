<div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30 hidden" id="backdrop-effect"></div>
<!-- drawer component -->
<div id="pengumuman-update"
    class="fixed top-0 left-0 z-40 shadow-2xl h-screen p-4 overflow-y-auto transition-transform rounded-r-lg -translate-x-full bg-white w-2/5 dark:bg-gray-800"
    tabindex="1" aria-labelledby="pengumuman-update-label">
    <h5 id="drawer-label"
        class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
        <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
        </svg>Pengumuman Edit
    </h5>
    <button id="backdrop-effect-close" type="button" aria-controls="pengumuman-update"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form method="POST" class="mb-6" id="editPengumuman" enctype="multipart/form-data">
        {{-- @csrf --}}

        <input type="hidden" id="pengumumanIdEdit">
        <div class="mb-3">
            {{-- <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label> --}}
            <input type="text" id="judulEdit" name="judulEdit"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan Judul" required />
        </div>
        <div class="mb-3">
            {{-- <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label> --}}
            <textarea id="deskripsiEdit" name="deskripsiEdit" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required placeholder="Masukkan Deskripsi"></textarea>
        </div>
        <div class="mb-3">
            <select required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="tipeEdit" id="tipeEdit">
                <option value="" id="tipeOption" selected></option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->tipe }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            {{-- <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label> --}}
            <input type="text" id="keteranganEdit" name="keteranganEdit"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan Keteragan (Opsional)" />
        </div>
        <div class="mb-3">
            {{-- <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label> --}}
            <input type="file" id="gambarEdit" name="gambarEdit" accept="image/*"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan Gambar (Opsional)" />
            <p class="mt-1 text-[12px] text-gray-500 dark:text-gray-300">Gambar dapat kosong / Opsional</p>

        </div>

        <div class="hidden mb-3" id="imagePreviewEdit">
            <button class="text-red-500 font-semibold" type="button" onclick="hapusImage()">Hapus Gambar?</button>
            <img id="previewImgEdit" class="w-full shadow border-2 border-white rounded dark:border-gray-800"
                src="" alt="">
        </div>
        <button type="submit" id="createSubmit"
            class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg
                class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
                <path
                    d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z" />
            </svg> Tambah Pengumuman</button>
    </form>
</div>


<script>


    const inputGambarEdit = document.getElementById('gambarEdit');
    const previewImgEdit = document.getElementById('previewImgEdit');
    const imagePreviewEdit = document.getElementById('imagePreviewEdit');
    document.getElementById('gambarEdit').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImgEdit.src = e.target.result;
                imagePreviewEdit.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    });

    function hapusImage(e) {
        inputGambarEdit.value = null
        previewImgEdit.src = null;
        imagePreviewEdit.classList.add('hidden');
    }


    // JQEURY START
    // CLOSE MODAL
    $('body').on('click', '#backdrop-effect-close', function() {
        $('#pengumuman-update').addClass('-translate-x-full');
        $('#backdrop-effect').addClass('hidden');

        $('#judulEdit').val('')
        $('#deskripsiEdit').val('')
        $('#tipeOption').val('')
        $('#tipeOption').text('Pilih Tipe')
        $('#keteranganEdit').val('')
        
        $('#previewImgEdit').src = null
        imagePreviewEdit.classList.add('hidden')
    })

    $('body').on('click', '#backdrop-effect', function() {
        $('#pengumuman-update').addClass('-translate-x-full');
        $('#backdrop-effect').addClass('hidden');

        $('#judulEdit').val('')
        $('#deskripsiEdit').val('')
        $('#tipeOption').val('')
        $('#tipeOption').text('Pilih Tipe')
        $('#keteranganEdit').val('')
        
        $('#previewImgEdit').src = null
        imagePreviewEdit.classList.add('hidden')
    })

    // OPEN MODAL
    $('body').on('click', '#btn-edit-pengumuman', async function() {
        let pengumumanId = $(this).data('id')
        console.log(pengumumanId);
        $.ajax({
            url: `/pengumuman/${pengumumanId}`,
            method: 'GET',
            success: async function(res) {
                console.log(res);
                $('#pengumumanIdEdit').val(res.data.id)
                $('#judulEdit').val(res.data.judul)
                $('#deskripsiEdit').val(res.data.deskripsi)
                
                if (res.data.tipe) {
                    $('#tipeOption').val(res.data.tipe.id)
                    $('#tipeOption').text(res.data.tipe.tipe)
                }

                $('#keteranganEdit').val(res.data.keterangan)
                if (res.data.gambar) {
                    previewImgEdit.src = `/storage/${res.data.gambar}`;
                    imagePreviewEdit.classList.remove('hidden');
                } else {
                    previewImgEdit.src = null;
                    imagePreviewEdit.classList.add('hidden');
                }

            }
        })

        $('#backdrop-effect').removeClass('hidden');
        $('#pengumuman-update').removeClass('-translate-x-full');
    })

    $(document).ready(function() {
        $('#editPengumuman').on('submit', function(e) {
            e.preventDefault()

            let token = $('meta[name="csrf-token"]').attr('content')

            var formData = new FormData(this);

            let pengumumanId = $('#pengumumanIdEdit').val()
            
            $.ajax({
                url: `/pengumuman/${pengumumanId}?_method=put`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                contentType: false,
                processData: false,
                data: formData,
                success: function(res) {
                    let pengumumanData = `
                    <tr id="pengumuman-${res.data.id}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${res.data.judul}
                        </th>
                        <td class="px-6 py-4">
                            ${res.data.guru.nama}
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-500 py-0.5 px-1 rounded">${res.data.tipe.tipe}</span>
                        </td>
                        <td class="px-6 py-4">
                            ${res.data.tanggal}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <button data-drawer-backdrop="false" id="btn-edit-pengumuman" data-id="${res.data.id}" type="button" data-drawer-target="pengumuman-update"
                                    data-drawer-show="pengumuman-update" aria-controls="pengumuman-update"
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
                                <button id="btn-detail-pengumuman" data-id="${res.data.id}" type="button" aria-controls="drawer-read-product-advanced"
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
                    `;

                    $('#editPengumuman')[0].reset()

                    $(`#pengumuman-${res.data.id}`).replaceWith(pengumumanData);

                    $('#previewImgEdit').src = null;
                    $('#imagePreviewEdit').addClass('hidden');

                    $('#pengumuman-update').addClass('-translate-x-full');
                    $('#backdrop-effect').addClass('hidden');

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Pengumuman Ditambahkan"
                    });


                    console.log(res);
                }
            })

        });
    });
</script>
