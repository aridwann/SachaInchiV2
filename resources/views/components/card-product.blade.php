@props(['product', 'landingpage'])

<div class="flex flex-col hover:scale-105 transition cursor-pointer {{ $landingpage ? 'h-full flex-1 gap-4 rounded-lg min-w-40' : 'gap-3 pb-3' }}"
    onclick="location.href = 'products/{{ $product['id'] }}'">
    <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
        style="background-image: url({{ asset($product->img) }});">
    </div>
    <div>
        <p class="text-white text-sm md:text-base font-medium leading-normal">
            {{ $product['name'] }}
        </p>
        <p class="text-[#A3C299] text-xs md:text-sm font-normal leading-normal">
            Stok: {{ $product->stock }}
        </p>
        <p class="text-[#54D12B] text-sm md:text-base font-bold leading-normal my-2">
            Rp. @convert($product['price'])
        </p>
    </div>
</div>
