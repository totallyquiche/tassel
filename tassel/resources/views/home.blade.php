<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tassel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

        @livewireStyles

        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    </head>
    <body class="bg-cyan-900">
        <main class="w-8/12 mx-auto text-slate-300">
            <h1 class="text-center text-5xl my-12 text-rose-100">Write Something.</h1>

            @livewire('random-prompt')

            <div id="toolbar" class="mt-8 bg-slate-300">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <select class="ql-font"><select>
                <select class="ql-header"><select>
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
                <button class="ql-link"></button>
                <button class="ql-clean"></button>
                <button id="ql-save-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="lightslategray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </button>
            </div>

            <div class="text-slate-800 mt-4 mb-12 bg-slate-300 h-96 overflow-auto">
                <div id="editor"></div>
            </div>
        </main>

        @livewireScripts

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script>
            const quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar',
                },
                placeholder: 'Write something...',
            });
        </script>

        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>

        <script>
            tippy('.randomPromptButton', {
                content: 'Get a new prompt',
                trigger: 'mouseenter',
                delay: 500,
            });
        </script>
    </body>
</html>
