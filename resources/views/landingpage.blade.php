<x-layout>
    <div class="flex justify-center flex-1 px-1 py-5 lg:px-40">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="@container " id="beranda">
                <div class="md:p-4">
                    <div class="flex min-h-[480px] flex-col bg-cover bg-left md:bg-center bg-no-repeat md:gap-5 md:rounded-xl justify-center mx-4 md:mx-0"
                        style="background-image: linear-gradient(to right,
                        rgba(0, 0, 0, 0.7) 30%,rgba(0, 0, 0, 0.1) 100%
                    ), url('/img/sachainchi.jpeg');">
                        <div class="flex flex-col w-full gap-2 mt-16 ms-2 md:ms-10">
                            <h1
                                class="text-white lg:text-4xl font-black leading-8 tracking-[-0.033em] text-xl md:text-2xl md:font-black md:leading-tight md:tracking-[-0.033em]">
                                Nikmati Kelezatan <br /> Sacha Inchi dari Desa Kami
                            </h1>
                            <h2
                                class="text-xs font-normal leading-normal text-white md:text-base md:font-normal md:leading-normal">
                                Produk olahan kacang Sacha Inchi berkualitas tinggi, <br>
                                langsung dari petani lokal.
                            </h2>
                        </div>
                        <button
                            class="flex mt-4 ms-2 md:ms-10 mb-16 md:mb-0 min-w-[50px] max-w-[120px] md:max-w-[150px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-2 md:h-10 md:px-4 bg-[#54D12B] text-[#172112] text-sm font-bold leading-normal tracking-[0.015em] md:text-base md:font-bold md:leading-normal md:tracking-[0.015em]"
                            onclick="location.href = '/products'">
                            <span class="truncate">Lihat Produk</span>
                        </button>
                    </div>
                </div>
            </div>
            <section class="my-5">
                <h2 id="produk"
                    class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 ">
                    Produk Unggulan
                </h2>
                <div
                    class="flex overflow-y-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&amp;::-webkit-scrollbar]:hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 w-full mx-auto gap-5 p-4">
                        @foreach ($products as $product)
                            @if (!$product->ishide)
                                <x-card-product :product="$product" :landingpage="true"></x-card-product>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center px-4 py-3">
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#54D12B] text-[#172112] text-sm font-bold leading-normal tracking-[0.015em]">
                        <span onclick="location.href = '/products'" class="truncate">Lihat Semua Produk</span>
                    </button>
                </div>
            </section>
            <section class="my-5 ">
                <h2 id="tentang"
                    class=" text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3">
                    Tentang Kami
                </h2>
                <div class=" grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                    <div class="flex flex-col gap-3 pb-3">
                        <div class="w-full bg-center bg-no-repeat aspect-[10/5] bg-cover rounded-xl"
                            style="background-image: url('img/village.png');">
                        </div>
                        <div>
                            <p class="text-xl font-medium leading-normal text-white">
                                Sacha Inchi
                            </p>
                            <p class="text-[#A3C299] text-base/relaxed text-justify font-normal">
                                Sacha Inchi adalah UMKM yang berdedikasi untuk menghasilkan
                                produk Sacha Inchi berkualitas tinggi. Kami bekerja sama
                                dengan petani lokal untuk memastikan keberlanjutan dan
                                kesejahteraan bersama. Produk kami diolah dengan cermat
                                untuk menjaga kandungan nutrisi dan rasa alami Sacha Inchi.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="my-5 ">
                <h2 class=" text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3">
                    Testimoni
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-4">
                    @foreach ([['Saya merasakan manfaat Minyak Sacha Inchi ini untuk kesehatan kulit dan rambut.', 'Aisyah'], ['Kacang Sacha Inchi panggangnya enak dan renyah. Cocok untuk camilan sehat.', 'Budi'], ['Teh Sacha Inchi-nya menenangkan dan rasanya unik. Saya suka minum sebelum tidur.', 'Citra']] as $person)
                        <figure class="flex-grow mb-8">
                            <div class="flex items-center mb-4 text-yellow-300">
                                @for ($i = 0; $i < 6; $i++)
                                    <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                            </div>
                            <blockquote>
                                <p class="text-base font-semibold text-[#A3C299]">
                                    {{ $person[0] }}</p>
                            </blockquote>
                            <figcaption class="flex items-center mt-3 space-x-3 rtl:space-x-reverse">
                                <img class="w-6 h-6 rounded-full" src="img/default-avatar.png" alt="profile picture">
                                <div
                                    class="flex items-center divide-x-2 divide-gray-300 rtl:divide-x-reverse dark:divide-gray-700">
                                    <cite class="pe-3 text-base font-medium text-[#A3C299]">{{ $person[1] }}</cite>
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </section>
            <section class="my-5 ">
                <h2 class=" text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3">
                    Lokasi
                </h2>
                <div class="flex px-4 py-3 ">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.4672802018376!2d107.07023227442029!3d-6.95407576808124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6845c62e575ff9%3A0x11125b21caac12c5!2sBumdes%20Jaya%20Bersama!5e0!3m2!1sid!2sid!4v1748526393703!5m2!1sid!2sid"
                        maptype="satellite" width="700" height="450" style="border: 0" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="object-cover w-full bg-center bg-no-repeat bg-cover aspect-video rounded-xl">
                    </iframe>
                </div>
            </section>
        </div>
    </div>
</x-layout>
