<x-app-layout>
    <x-slot name="header">Tassel Writer</x-slot>

    <div class="leading-loose">
        <p class="text-white">       
            Writing prompts are great but some people just aren't motivated by writing challenges
            or social media. Tassel Writer presents you with a prompt and an editor and let's you
            do your thing your way.
        </p>

        <br/><br/>

        <div class="text-center">
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 text-2xl rounded-md" href="{{ route('register') }}">Get Started</a>
        </div>
    </div>
</x-app-layout>
