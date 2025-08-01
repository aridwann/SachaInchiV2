<x-layout>
    <div class="px-1 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            @if (session('success'))
                <div x-data="{ show: true }" x-transition.duration.500ms x-init="setTimeout(() => show = false, 2500)" x-show="show"
                    class="bg-green-100 text-green-800 p-3 mx-4 rounded mb-4 transition">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-wrap gap-2 p-4">
                <a class="text-[#A3C299] text-base font-medium leading-normal hover:underline" href="/products">Produk</a>
                <span class="text-[#A3C299] text-base font-medium leading-normal">/</span>
                <span class="text-white text-base font-medium leading-normal">{{ $product['name'] }}</span>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-100 m-4 gap-1 overflow-hidden bg-white aspect-[9/10] rounded-xl flex">
                    <div class="w-full bg-center bg-no-repeat aspect-auto bg-cover rounded-none flex-1"
                        style="background-image: url({{ asset($product->img) }});">
                    </div>
                </div>
                <div>
                    <h1
                        class="text-white text-2xl font-bold leading-tight tracking-[-0.015em] px-4 text-left pb-3 pt-5">
                        {{ $product['name'] }}
                    </h1>
                    <h3
                        class="text-[#54D12B] md:min-w-[350px] bg-[#273620] text-3xl font-bold leading-tight tracking-[-0.015em] mx-4 px-6 py-4">
                        Rp @convert($product['price'])
                    </h3>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <input type="hidden" name="name" value="{{ $product['name'] }}">
                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                        <input type="hidden" name="img" value="{{ $product['img'] }}">
                        <input type="number" name="quantity" id="quantityInput" value="1" min="1" hidden>

                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4 m-5">
                            <dt class="font-medium text-white">Stok</dt>
                            <dd class="text-[#A3C299]">
                                <div class="flex items-center rounded  w-30">
                                    {{ $product->stock }}
                                </div>
                            </dd>
                        </div>
                        @if ($product->stock == 'Tersedia')
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4 m-5">
                                <dt class="font-medium text-white">Jumlah</dt>
                                <dd class="text-[#A3C299]">
                                    <div class="flex items-center rounded border border-[#A3C299] w-30">
                                        <button type="button" id="kurangBtn"
                                            class="size-10 leading-10 text-[#A3C299] transition hover:opacity-75 ">&minus;</button>
                                        <input type="number" id="Quantity" value="1" min="1"
                                            class="h-10 w-10 text-center sm:text-sm" readonly />
                                        <button type="button" id="tambahBtn"
                                            class="size-10 leading-10 text-[#A3C299] transition hover:opacity-75">&plus;</button>
                                    </div>
                                </dd>
                            </div>
                            <div class="flex justify-stretch">
                                <div class="flex flex-1 gap-3 flex-wrap px-4 py-3 justify-start">
                                    <button type="submit"
                                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#f5f2f0] text-[#172112] text-sm font-bold leading-normal tracking-[0.015em]">
                                        <span class="truncate">Tambah ke Keranjang</span>
                                    </button>
                                    <p onclick="prosesPesanan({{ Auth::user() }}, {{ $product }})"
                                        class="cursor-pointer flex min-w-[84px] max-w-[480px] items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#54D12B] text-[#172112] text-sm font-bold leading-normal tracking-[0.015em]">
                                        <span class="truncate">Pesan via WhatsApp</span>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div>
                <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Deskripsi</h3>
                <p class="text-[#A3C299] text-base font-normal leading-normal pb-3 pt-1 px-4 text-justify">
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>
</x-layout>
<script>
    const kurangBtn = document.getElementById('kurangBtn');
    const tambahBtn = document.getElementById('tambahBtn');
    const qtyInput = document.getElementById('Quantity');
    const hiddenQty = document.getElementById('quantityInput');

    kurangBtn.addEventListener('click', () => {
        let value = parseInt(qtyInput.value);
        if (value > 1) {
            qtyInput.value = value - 1;
            hiddenQty.value = value - 1;
        }
    });

    tambahBtn.addEventListener('click', () => {
        let value = parseInt(qtyInput.value);
        qtyInput.value = value + 1;
        hiddenQty.value = value + 1;
    });

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function prosesPesanan(user, product) {
        if (!user.phone && !user.address) {
            Swal.fire({
                icon: 'info',
                title: 'Lengkapi Profil',
                text: 'Silakan lengkapi terlebih dahulu data anda.',
                confirmButtonColor: '#54D12B'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('/profile', '_self');
                }
            });
            return
        }
        const qty = hiddenQty.value
        const total = qty * product.price
        let pesan =
            `*Nama:* ${user.name} \n*No. HP:* ${user.phone}\n*Alamat:* ${user.address}\n*Pesanan:*\n -> ${product.name} x${qty} (Rp ${formatRupiah(total)})\n\n*Total: Rp ${formatRupiah(total)}*`;
        const encodedMessage = encodeURIComponent(pesan);
        const waURL = `https://wa.me/6281563229577?text=${encodedMessage}`;

        window.open(waURL, '_blank');
    }
</script>
