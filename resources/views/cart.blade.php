<x-layout>
    <div class="flex px-1 lg:px-40 justify-center py-5">
        <div class="layout-content-container flex flex-col px-4 md:px-0 max-w-[960px] flex-1">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-white">Keranjang</h1>

            <div class="overflow-x-auto border border-[#A3C299] rounded-xl md:block">
                <table class="min-w-full text-xs text-[#A3C299]">
                    <thead class="bg-[#172112]">
                        <tr>
                            <th class="text-left p-3">Produk</th>
                            <th class="text-left p-3 hidden md:block">Harga</th>
                            <th class="text-left p-3">Qty</th>
                            <th class="text-left p-3">Total</th>
                            <th class="text-center p-3">Hapus Produk</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#172112]">
                        @foreach ($cart as $productId => $item)
                            @php $total = $item['price'] * $item['quantity']; @endphp
                            <tr id="row-{{ $productId }}" class="border-t border-[#A3C299]">
                                <td class="p-3 flex items-center gap-3">
                                    <input type="checkbox" class="w-4 h-4 cursor-pointer checkbox-item"
                                        data-id="{{ $productId }}" />
                                    <div class="hidden md:block w-20 h-20 bg-cover bg-center rounded-lg"
                                        style="background-image: url('{{ $item['img'] }}');"></div>
                                    {{ $item['name'] }}
                                </td>
                                <td class="hidden md:table-cell p-3">Rp @convert($item['price'])</td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <button onclick="updateQty('{{ $productId }}', -1)"
                                            class="size-6 text-xl font-bold">-</button>
                                        <span id="qty-{{ $productId }}">{{ $item['quantity'] }}</span>
                                        <button onclick="updateQty('{{ $productId }}', 1)"
                                            class="size-6 text-xl font-bold">+</button>
                                    </div>
                                </td>
                                <td class="p-3" id="total-{{ $productId }}">Rp @convert($total)</td>
                                <td class="p-3 flex justify-center items-center">
                                    <button onclick="confirmRemove('{{ $productId }}')"
                                        class="text-red-500 hover:text-red-700 text-xl">🗑️</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <p class="text-base text-white">Subtotal: <strong id="subtotal">Rp 0</strong></p>
                <button onclick="prosesPesanan({{ Auth::user() }})"
                    class="flex items-center gap-2 bg-[#54D12B] text-[#172112] font-bold px-4 py-2 rounded-xl text-sm hover:bg-[#4cc224] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84Z" />
                    </svg>
                    Pesan via WhatsApp
                </button>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateQty(id, change) {
            const qtyElement = document.getElementById('qty-' + id);
            let qty = parseInt(qtyElement.textContent) + change;

            if (qty < 1) {
                confirmRemove(id);
                return;
            }

            fetch(`/cart/update/${id}/${qty}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        qtyElement.textContent = data.cart[id].quantity;
                        document.getElementById('total-' + id).textContent = 'Rp ' + formatRupiah(data.cart[id].price *
                            data.cart[id].quantity);
                        updateSubtotalFromCheckbox();
                    }
                });
        }

        function confirmRemove(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Apakah kamu yakin ingin menghapus produk ini dari keranjang?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#888',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeItem(id);
                }
            });
        }

        function removeItem(id) {
            fetch(`/cart/remove/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('row-' + id).remove();
                        updateSubtotalFromCheckbox();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil dihapus!',
                            text: 'Produk berhasil dihapus dari keranjang.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
        }

        function updateSubtotalFromCheckbox() {
            const checkboxes = document.querySelectorAll('.checkbox-item');
            let subtotal = 0;

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const row = cb.closest("tr");
                    const totalText = row.querySelector("td:nth-child(4)").textContent.trim();
                    subtotal += parseInt(totalText.replace(/[Rp\s.]/g, ""));
                }
            });

            document.getElementById('subtotal').textContent = 'Rp ' + formatRupiah(subtotal);
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        document.querySelectorAll('.checkbox-item').forEach(cb => {
            cb.addEventListener('change', updateSubtotalFromCheckbox);
        });

        function prosesPesanan(user) {
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
            const checkboxes = document.querySelectorAll('.checkbox-item');
            let total = 0;
            let pesan =
                `*Nama:* ${user.name} \n*No. HP:* ${user.phone}\n*Alamat:* ${user.address}\n*Pesanan:*\n`;
            let selected = 0;
            let idsToRemove = [];

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const row = cb.closest("tr");
                    const id = cb.getAttribute('data-id');
                    const name = row.querySelector("td:nth-child(1)").textContent.trim();
                    const qty = parseInt(row.querySelector("span[id^='qty-']").textContent);
                    const totalHarga = row.querySelector("td:nth-child(4)").textContent.trim();
                    pesan += ` -> ${name} x${qty} (${totalHarga})\n`;
                    total += parseInt(totalHarga.replace(/[Rp\s.]/g, ""));
                    selected++;
                    idsToRemove.push(id);
                }
            });

            if (selected === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Belum ada produk terpilih',
                    text: 'Silakan pilih produk yang ingin kamu pesan.',
                    confirmButtonColor: '#54D12B'
                });
                return;
            }

            pesan += `\n*Total: Rp ${formatRupiah(total)}*`;
            const encodedMessage = encodeURIComponent(pesan);
            const waURL = `https://wa.me/6281563229577?text=${encodedMessage}`;

            window.open(waURL, '_blank');

            fetch('/cart/remove-selected', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    ids: idsToRemove
                })
            }).then(() => {
                location.reload();
            });
        }
    </script>
</x-layout>
