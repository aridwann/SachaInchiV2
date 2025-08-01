<x-layout>
    <div class="px-1 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            @if (session('success'))
                <div x-data="{ show: true }" x-transition.duration.500ms x-init="setTimeout(() => show = false, 2500)" x-show="show"
                    class="bg-green-100 text-green-800 p-3 mx-4 rounded mb-4 transition">
                    {{ session('success') }}
                </div>
            @endif
            <div class="flex flex-wrap justify-between gap-3 p-4">
                <p class="text-white tracking-light text-2xl md:text-[32px] font-bold leading-tight min-w-72">Kelola
                    Produk</p>
            </div>
            <div class="px-4 md:py-3">
                <label class="flex flex-col min-w-40 h-12 w-full">
                    <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                        <div class="text-[#a3c398] flex border-none bg-[#2f4328] items-center justify-center pl-4 rounded-l-xl border-r-0 text-[24px]"
                            data-icon="MagnifyingGlass" data-size="24px" data-weight="regular">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full gap-4 items-center">
                            <form action="/dashboard" class="w-full">
                                <input placeholder="Cari Produk"
                                    class="form-input w-full flex min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border-none bg-[#2f4328] focus:border-none h-full placeholder:text-[#a3c398] px-4 rounded-l-none border-l-0 pl-2 text-sm md:text-base font-normal leading-normal"
                                    name="query" autofocus />
                            </form>
                            <button
                                class="flex min-w-fit max-w-[150px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-10 @[480px]:px-4 bg-[#54D12B] text-[#172112] text-xs md:text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]"
                                onclick="location.href = '/dashboard/create'">
                                <span class="truncate">Tambah Produk</span>
                            </button>
                        </div>
                    </div>
                </label>
            </div>
            <div class="px-4 py-3 @container">
                <div class="flex overflow-hidden rounded-xl border border-[#436039] bg-[#162013]">
                    <table class="flex-1">
                        <thead>
                            <tr class="bg-[#21301c]">
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-120 px-4 py-3 text-left text-white text-sm font-medium leading-normal">
                                    #</th>
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 px-4 py-3 text-left text-white w-14 text-sm font-medium leading-normal">
                                    Preview</th>
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-176 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">
                                    Nama Produk</th>
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 px-4 py-3 text-left text-white w-60 text-sm font-medium leading-normal">
                                    Stok</th>
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">
                                    Harga</th>
                                <th
                                    class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-656 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">
                                    Deskripsi Produk
                                </th>
                                <th class="px-4 py-3 text-left text-white w-60 text-sm font-medium leading-normal">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t border-t-[#436039]">
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-120 h-[72px] px-4 py-2 text-[#a3c398] text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        {{ $loop->iteration }}</td>
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 h-[72px] px-4 py-2 w-14 text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-10"
                                            style='background-image: url("{{ $product->img }}");'></div>
                                    </td>
                                    {{-- @dd($product->img) --}}
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-176 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        {{ $product->name }}</td>
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        <button
                                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#2f4328] text-white text-sm font-medium leading-normal w-full">
                                            <span class="truncate">{{ $product->stock }}</span>
                                        </button>
                                    </td>
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 h-[72px] px-4 py-2 w-[400px] text-[#a3c398] text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        Rp. {{ number_format($product->price, 0) }}
                                    </td>
                                    <td
                                        class="table-480a6191-e45f-4b9a-85c9-0caed492694b-column-656 h-[72px] px-4 py-2 w-[400px] text-[#a3c398] text-sm font-normal leading-normal {{ $product->ishide ? 'grayscale' : '' }}">
                                        {{ Str::limit($product->description, 30) }}
                                    </td>
                                    <td
                                        class="h-[72px] px-4 py-2 w-60 text-[#a3c398] text-sm font-bold leading-normal tracking-[0.015em]">
                                        <a href="/dashboard/{{ $product->id }}/edit"
                                            class="text-green-500 me-1">Edit</a> |
                                        <form action="/dashboard/{{ $product->id }}" method="post"
                                            class="ms-1 text-red-500 inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="cursor-pointer">Hapus</button>
                                        </form>
                                        <form method="post" action="/dashboard/{{ $product->id }}/ishide"
                                            class="text-gray-400 ">
                                            @csrf
                                            @method('PATCH')
                                            @if ($product->ishide)
                                                <button class="cursor-pointer">Tampilkan</button>
                                            @else
                                                <button class="cursor-pointer">Sembunyikan</button>
                                            @endif
                                        </form>
                                        {{-- @dd($product->ishide) --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
                <style>
                    @container(max-width:120px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-120 {
                            display: none;
                        }
                    }

                    @container(max-width:176px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-176 {
                            display: none;
                        }
                    }

                    @container(max-width:296px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-296 {
                            display: none;
                        }
                    }

                    @container(max-width:416px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-416 {
                            display: none;
                        }
                    }

                    @container(max-width:536px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-536 {
                            display: none;
                        }
                    }

                    @container(max-width:656px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-656 {
                            display: none;
                        }
                    }

                    @container(max-width:776px)

                        {
                        .table-480a6191-e45f-4b9a-85c9-0caed492694b-column-776 {
                            display: none;
                        }
                    }
                </style>
            </div>
        </div>
    </div>
</x-layout>
