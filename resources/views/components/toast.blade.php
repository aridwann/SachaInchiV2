<div x-data="{ show: false, message: '' }" x-on:success.window="message= $event.detail; show= true; setTimeout(()=>show=false, 3000)"
    x-show="show" x-text="message" x-transition.duration.500ms
    class="bg-green-100 text-green-800 p-3 mx-4 rounded mb-4 transition"></div>
