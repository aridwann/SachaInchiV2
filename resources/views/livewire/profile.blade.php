<form wire:submit.prevent="update" enctype="multipart/form-data" x-data="{ changed: false }"
    class="px-1 lg:px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <x-toast />
        <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
            Profile
        </h2>
        <div class="flex p-4 @container">
            <div class="flex w-full flex-col gap-4 items-center">
                <div class="flex gap-4 flex-col items-center" x-data="{ preview: '{{ asset($avatar ?? 'img/default-avatar.png') }}' }">
                    <div id="preview"
                        class="bg-center bg-no-repeat aspect-square bg-cover rounded-full min-h-32 w-32 relative"
                        :style="`background-image: url('${preview}')`">
                        <div class="w-full items-end px-4 py-3">
                            <label
                                class="absolute bottom-0 right-0 flex justify-center items-center rounded-full w-10 h-10 bg-[#172112] border-[#54D12B] cursor-pointer hover:scale-95 border-2"
                                for="user_avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#54D12B">
                                    <path
                                        d="M120-120v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm584-528 56-56-56-56-56 56 56 56Z" />
                                </svg>
                            </label>
                            <input @input="changed = true"
                                @change="preview = URL.createObjectURL($event.target.files[0])" class="hidden"
                                aria-describedby="user_avatar_help" id="user_avatar" type="file"
                                accept="image/jpg, image/png, image/jpeg" name="avatar" wire:model="newAvatar" />
                        </div>
                    </div>
                    @error('avatar')
                        <p class="text-red-500 text-xs -mt-2">{{ $message }}</p>
                    @enderror
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] text-center">
                            {!! $name .
                                ($user->is_admin
                                    ? ' <span class="text-transparent text-sm bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-800">(Admin)</span>'
                                    : '') !!}
                        </p>
                        <p class="text-[#A3C299] text-base font-normal leading-normal text-center">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex w-full flex-wrap items-end gap-4 px-4 py-2">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-white text-base font-medium leading-normal pb-2">
                    Nama
                </p>
                <input @input="changed = true"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-[#A3C299] bg-[#202d19] focus:border-[#A3C299] h-14 placeholder:text-[#A3C299] p-[15px] text-base font-normal leading-normal"
                    name="name" id="name" wire:model="name" />
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </label>
        </div>
        <div class="flex w-full flex-wrap items-end gap-4 px-4 py-2">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-white text-base font-medium leading-normal pb-2">
                    Nomor Telepon
                </p>
                <input @input="changed = true"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-[#A3C299] bg-[#202d19] focus:border-[#A3C299] h-14 placeholder:text-[#A3C299] p-[15px] text-base font-normal leading-normal"
                    name="phone" id="phone" type="number" wire:model="phone" />
                @error('phone')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </label>
        </div>
        <div class="flex w-full flex-wrap items-end gap-4 px-4 py-2">
            <label class="flex flex-col min-w-40 flex-1">
                <p class="text-white text-base font-medium leading-normal pb-2">
                    Alamat
                </p>
                <textarea @input="changed = true"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-white focus:outline-0 focus:ring-0 border border-[#A3C299] bg-[#202d19] focus:border-[#A3C299] h-14 placeholder:text-[#A3C299] p-[15px] text-base font-normal leading-normal"
                    id="address" name="address" wire:model="address"></textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </label>
        </div>

        <div x-show="changed" x-transition class="flex flex-col md:flex-row mx-4 my-3 gap-4" id="buttons">
            <button type="submit" @click="changed = false"
                class="cursor-pointer md:max-w-max md:flex-grow-0 rounded-lg h-10 px-4 bg-[#54D12B] text-[#172112] text-sm font-bold">
                Simpan Perubahan
            </button>
            <a href="/profile"
                class="flex items-center justify-center cursor-pointer md:max-w-max md:flex-grow-0 rounded-lg h-10 px-4 bg-red-600 text-white text-sm font-bold">
                Batalkan Perubahan
            </a>
        </div>
    </div>
</form>
