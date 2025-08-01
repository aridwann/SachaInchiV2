<x-layout>
    <div class="px-1 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">

            <div class="flex flex-wrap gap-2 p-4">
                <span class="text-white text-xl font-bold leading-normal">Tambah Produk</span>
            </div>

            <form action="/dashboard" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-8 p-4">
                    <div class="w-full md:w-1/2">
                        <label for="image" class="block text-sm font-medium text-[#A3C299] mb-2">Gambar Produk</label>
                        <img class="rounded-xl mb-4 w-100 object-cover aspect-[9/10]" id="preview">
                        <input accept="image/png,image/jpg,image/jpeg" type="file" name="img" id="img"
                            class="block w-full md:w-100 rounded-lg border border-[#4abd21] text-sm text-[#A3C299] file:mr-4 file:py-2 file:px-4 file:rounded-s-lg file:border-0 file:text-sm file:font-semibold file:bg-[#54D12B] file:text-[#172112] hover:file:bg-[#4abd21]">
                        @error('img')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/2">
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-[#A3C299] mb-2">Nama
                                Produk</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full bg-[#2f4328] border border-[#436039] text-white rounded-lg p-3 focus:ring-[#54D12B] focus:border-[#54D12B]">
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="stock" class="block text-sm font-medium text-[#A3C299] mb-2">Stok</label>
                            <select name="stock" id="stock"
                                class="w-full bg-[#2f4328] border border-[#436039] text-white rounded-lg p-3 focus:ring-[#54D12B] focus:border-[#54D12B]">
                                <option value="">Pilih Status</option>
                                <option value="Tersedia" {{ old('stock') === 'Tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="Kosong" {{ old('stock') === 'Kosong' ? 'selected' : '' }}>Kosong</option>
                            </select>
                            @error('stock')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="price" class="block text-sm font-medium text-[#A3C299] mb-2">Harga</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">Rp</span>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="w-full bg-[#2f4328] border border-[#436039] text-white rounded-lg p-3 pl-9 focus:ring-[#54D12B] focus:border-[#54D12B]">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description"
                                class="block text-sm font-medium text-[#A3C299] mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="6"
                                class="w-full bg-[#2f4328] border border-[#436039] text-white rounded-lg p-3 focus:ring-[#54D12B] focus:border-[#54D12B]">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex gap-4">
                            <button type="submit"
                                class="w-full flex items-center justify-center rounded-lg h-12 px-6 bg-[#54D12B] text-[#172112] text-sm font-bold leading-normal tracking-[0.015em] hover:bg-[#4abd21] transition-colors">
                                <span class="truncate">Tambah Produk</span>
                            </button>
                            <a href="/dashboard"
                                class="w-full flex items-center justify-center rounded-lg h-12 px-6 bg-red-600 text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-red-700 transition-colors">
                                <span class="truncate">Batal</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>

<script>
    const img = document.getElementById('img');
    const preview = document.getElementById('preview');

    img.addEventListener('change', function() {
        const file = this.files[0];
        preview.src = URL.createObjectURL(file);
    });
</script>
