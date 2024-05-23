<div id="edit-tipe-modal" tabindex="-1"
    class="transition-all fixed top-0 left-0 right-0 z-50  p-4 hidden justify-center items-center overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full h-auto max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeEdit-pengumuman-modal" type="button"
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
                <form id="editTipeForm" class="flex justify-center items-center">
                    <input type="hidden" id="edit-id-tipe">
                    <input type="text" name="tipe" id="edit-tipe"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan Tipe Pengumuman" />
                    <button id="btn-edit-tipe-submit" type="submit"
                        class="transition-all flex justify-center items-center text-white bg-gradient-to-r from-blue-700 via-blue-700 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-r-lg text-sm px-4 py-2 text-center me-2">
                        Submit
                    </button>
                </form>
                <p class="text-red-500 font-semibold text-start" id="updateTipeError"></p>
            </div>
        </div>
    </div>
</div>

<script>
    $('body').on('click', '#btn-edit-tipe', async function() {
        let tipeId = $(this).data('id')

        $('#edit-id-tipe').val(tipeId)

        await $.ajax({
            type: "GET",
            url: `/guru/tipe-laporan-ajax/${tipeId}`,
            success: function(res) {
                console.log(res);
                $('#edit-tipe').val(res.data.tipe)
            }
        })

        $('#backdrop-effect-tipe').removeClass('hidden')
        $('#edit-tipe-modal').removeClass('hidden')
        $('#edit-tipe-modal').addClass('flex')
    })

    $('body').on('click', '#closeEdit-pengumuman-modal', function() {
        $('#backdrop-effect-tipe').addClass('hidden')
        $('#edit-tipe-modal').addClass('hidden')
        $('#edit-tipe-modal').removeClass('flex')
    })

    $(document).ready(function() {
        $('#editTipeForm').on('submit', function(e) {
            e.preventDefault()

            let tipeId = $('#edit-id-tipe').val()

            let tipe = $('#edit-tipe').val()
            let formData = new FormData(this)
            console.log(tipeId);
            $.ajax({
                method: "POST",
                url: `/guru/tipe-laporan-ajax/${tipeId}?_method=put`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    // console.log(res.data.);

                    // $(`#table-tipe-${tipeId}`).empty()
                    $('#updateTipeError').empty()

                    let table = `
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
                                        <button id="btn-detail-tipe" data-id="${res.data.id}" type="button"
                                            aria-controls="drawer-read-product-advanced"
                                            class="py-2 px-2 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4">
                                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                            </svg>
                                        </button>
                                        <button id="btn-delete-tipe" type="button" data-id="${res.data.id}"
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
                    `
                    $(`#table-tipe-${tipeId}`).replaceWith(table)


                    $('#backdrop-effect-tipe').addClass('hidden')
                    $('#edit-tipe-modal').addClass('hidden')
                    $('#edit-tipe-modal').removeClass('flex')

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Tipe Laporan Diupdate!"
                    });

                },
                error: function(err) {
                    console.log(err.responseJSON.errors.tipe[0]);
                    $('#updateTipeError').html(`* ${err.responseJSON.errors.tipe[0]}`)
                }
            })
        })
    });
</script>
