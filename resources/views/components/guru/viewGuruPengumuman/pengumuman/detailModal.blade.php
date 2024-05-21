<!-- Delete Modal -->
<div id="detail-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50  p-4 hidden justify-center items-center overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">

</div>


<script>
    $('body').on('click', '#btn-detail-pengumuman', async function() {

        let pengumumanId = $(this).data('id')

        await $.ajax({
            type: "GET",
            url: `/pengumuman/${pengumumanId}`,
            success: function(res) {
                console.log(res);
                let image = `
                        <img data-modal-target="imageModal" data-modal-toggle="imageModal"
                            src="{{ asset('storage/${res.data.gambar}') }}" class="mb-5 rounded-lg lg:max-w-2xl shadow"
                            alt="${res.data.judul}">
                        `

                let keterangan = `
                <p class="mb-5 font-light text-gray-500 dark:text-gray-400">Keterangan: ${res.data.keterangan}</p>
                `

                let guruProPic = `{{ asset('assets/img/noProPic.png') }}`

                if (res.data.guru.proPic) {
                    guruProPic = `{{ asset('storage/${res.data.guru.proPic}') }}`
                }

                let detail = `
                    <div class="relative w-auto h-auto  sm:min-w-[600px] max-w-3xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button id="detail-pengumuman-modal" type="button"
                                class="absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="pt-10 text-start">
                                    <article
                                        class="py-6 px-5  rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700">
                                        <div class="flex justify-between items-center mb-5 text-gray-500">
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2 py-1.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                                <i class='bx bxs-info-circle mr-1 w-3 h-3'></i>
                                                ${res.data.tipe.tipe}
                                            </span>
                                            <span class="text-[15px]">${res.data.tanggal}</span>
                                        </div>
                                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            <p>${res.data.judul}</p>
                                        </h2>
                                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">${res.data.deskripsi}</p>
                                        ${res.data.gambar ? image : ''}
                                        ${res.data.keterangan && keterangan}
                    
                                        
                    
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center space-x-2">
                                                <img class="w-9 h-9 rounded-full"
                                                    src="${guruProPic}"
                                                    alt="${res.data.guru.nama}" />
                                                <div class="">
                                                    <p class="font-medium dark:text-white">${res.data.guru.nama}</p>
                                                    <button type="button" class="bg-orange-50 text-orange-500 rounded px-1">${res.data.guru.role}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                            </div>
                        </div>
                    </div>
                    `

            $('#detail-modal').html(detail)
            }
        });

        $('#detail-modal').removeClass('hidden')
        $('#detail-modal').addClass('flex')

        $('#backdrop-effect').removeClass('hidden')
    })

    $('body').on('click', '#detail-pengumuman-modal', function() {
        $('#detail-modal').addClass('hidden')
        $('#detail-modal').removeClass('flex')

        $('#backdrop-effect').addClass('hidden')
    })
</script>
