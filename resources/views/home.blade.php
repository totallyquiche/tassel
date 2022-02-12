<x-app-layout>
    <x-slot name="header">Tassel Writer</x-slot>

    <div id="overlay" class="flex items-center justify-center fixed top-[-100%] left-0 right-0 bottom-0 w-full h-full z-50 cursor-pointer bg-cyan-900 opacity-[0.95]" style="transition: top 0.20s ease-in-out;');">
        <img class="max-h-[25%]" src="{{ asset('storage/images/logo-white.png') }}" />
    </div>
</x-app-layout>
