<div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30 hidden" id="backdrop-effect"></div>
<!-- drawer component -->
<div id="pengumuman-update"
    class="fixed top-0 left-0 z-40 shadow-2xl h-screen p-4 overflow-y-auto transition-transform rounded-r-lg -translate-x-full bg-white w-2/5 dark:bg-gray-800"
    tabindex="1">
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

        <input type="hidden" id="laporanSiswaIdEdit">
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
            <button class="text-red-500 font-semibold" type="button" onclick="hapusImageEdit()">Hapus Gambar?</button>
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

    function hapusImageEdit(e) {
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
    $('body').on('click', '#btn-edit-laporanSiswa', async function() {
        console.log('asdv');
        let pengumumanId = $(this).data('id')
        console.log(pengumumanId);
        $.ajax({
            url: `/pengumuman/${pengumumanId}`,
            method: 'GET',
            success: async function(res) {
                console.log(res);
                $('#laporanSiswaIdEdit').val(res.data.id)
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

            let pengumumanId = $('#laporanSiswaIdEdit').val()
            
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
