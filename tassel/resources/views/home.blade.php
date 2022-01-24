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
                @livewire('quill-content-save-button')
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

            let originalDelta = JSON.stringify(quill.getContents());
            let currentDelta;

            quill.on('text-change', function() {
                currentDelta = JSON.stringify(quill.getContents());

                if (currentDelta === originalDelta) {
                    document.getElementById('ql-save-button').disabled = true;
                    document.getElementById('ql-save-button-icon').setAttribute('stroke', 'lightslategray');
                } else {
                    document.getElementById('ql-save-button').disabled = false;
                    document.getElementById('ql-save-button-icon').setAttribute('stroke', 'blue');
                }
            });

            document.getElementById('ql-save-button').addEventListener('click', function () {
                originalDelta = JSON.stringify(quill.getContents());

                document.getElementById('ql-save-button').disabled = true;
                document.getElementById('ql-save-button-icon').setAttribute('stroke', 'lightslategray');

                Livewire.emit('saveDelta', currentDelta);
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
