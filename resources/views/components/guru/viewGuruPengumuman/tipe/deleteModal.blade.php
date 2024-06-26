<!-- Delete Modal -->
<div id="delete-tipe-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50  p-4 hidden justify-center items-center overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full h-auto max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="delete-tipe-modal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                    stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Kamu Yakin Akan Menghapus Tipe Pengumuman Ini?</h3>
                <input type="hidden" value="" id="delete-tipe-id">
                <button type="button" id="delete-tipe-submit"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Hapus</button>
                <button id="delete-tipe-modal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('body').on('click', '#btn-delete-tipe', function() {
        $('#backdrop-effect-tipe').removeClass('hidden')
        $('#delete-tipe-modal').removeClass('hidden')
        $('#delete-tipe-modal').addClass('flex')
        
        let tipeId = $(this).data('id')
        
        console.log(tipeId);
        $('#delete-tipe-id').val(tipeId)
    })


    $('body').on('click', '#delete-tipe-submit', function() {

        let tipeId = $('#delete-tipe-id').val()
        console.log(tipeId);

        $.ajax({
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/tipe-pengumuman/${tipeId}`,
            success: function(res) {
                console.log(res);
                $('#table-tipe-' + tipeId).remove()

                $('#backdrop-effect').addClass('hidden')
                $('#delete-tipe-modal').addClass('hidden')
                $('#delete-tipe-modal').removeClass('flex')

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
                        title: "Tipe Pengumuman Dihapus!"
                    });
            }
        })
    })
    
    $('body').on('click', '#delete-tipe-modal', function() {
        $('#backdrop-effect-tipe').addClass('hidden')
        $('#delete-tipe-modal').addClass('hidden')
        $('#delete-tipe-modal').removeClass('flex')

        $('#delete-tipe-id').val('')
    })
</script>
