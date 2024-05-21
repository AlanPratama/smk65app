@extends('layouts.main')

@section('title', 'Pengumuman')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-3 px-3 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Pengumuman
                </h2>
                {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p> --}}
            </div>
            <div class="grid gap-8 grid-cols-1">
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach ($pengumuman as $p)
                    <article
                        class="py-6 px-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2 py-1.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                <i class='bx bxs-info-circle mr-1 w-3 h-3'></i>
                                {{ $p->tipe->tipe }}
                            </span>
                            <span class="text-[15px]">{{ Carbon::parse($p->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <p>{{ $p->judul }}</p>
                        </h2>
                        <p class="mb-5 text-lg text-justify text-gray-500 dark:text-gray-400">{{ $p->deskripsi }}</p>
                        @if ($p->gambar)
                            <img data-modal-target="imageModal-{{ $p->id }}"
                                data-modal-toggle="imageModal-{{ $p->id }}"
                                src="{{ asset('storage/' . $p->gambar) }}" class="mb-5 rounded-lg lg:max-w-xl shadow"
                                alt="{{ $p->judul }}">

                            <!-- IMAGE MODAL -->
                            <div id="imageModal-{{ $p->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-3xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <img src="{{ asset('storage/' . $p->gambar) }}" class="rounded-lg w-full shadow"
                                            alt="{{ $p->judul }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <p
                            class="mb-5 text-gray-500 text-lg dark:text-gray-400 flex flex-wrap justify-start items-center gap-1">
                            <span class="font-semibold">Keterangan:</span>
                            <span>{{ $p->keterangan ? $p->keterangan : '-' }}</span>
                        </p>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                @if ($p->guru)
                                    <img class="w-9 h-9 rounded-full"
                                        src="{{ $p->guru->proPic ? asset('storage/' . $p->guru->proPic) : asset('assets/img/noProPic.png') }}"
                                        alt="{{ $p->guru->nama }}" />
                                @else
                                    <img class="w-9 h-9 rounded-full" src="{{ asset('assets/img/noProPic.png') }}"
                                        alt="Guru SMKN 65 Jakarta" />
                                @endif
                                <div class="">
                                    <p class="font-medium dark:text-white">
                                        {{ $p->guru ? $p->guru->nama : 'Guru SMKN 65 Jakarta' }}</p>
                                    <button type="button"
                                        class="bg-orange-50 text-orange-500 rounded px-1">{{ $p->guru ? $p->guru->role : 'Guru' }}</button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
