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
            @livewire('dashboard-index')
        </div>
    </div>
</x-layout>
