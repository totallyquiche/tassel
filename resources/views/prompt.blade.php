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
        <main class="w-11/12 mx-auto text-slate-300">
            <a href="{{ route('prompt.random') }}">
                <h1 class="text-center text-5xl my-12 text-rose-100">Write Something.</h1>
            </a>

            <span>
                <span class="italic text-rose-200">Prompt:</span>

                {{ $prompt->text }}
            </span>

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
                @livewire('save-draft-button')
                @livewire('delete-drafts-button')
            </div>

            <div class="text-slate-800 mt-4 mb-12 bg-slate-300 h-96 overflow-auto">
                <div id="editor"></div>
            </div>

            <section>
                <h2 class="text-center text-3xl my-12 text-rose-100">Drafts</h2>

                @livewire('draft-cards')
            </section>

            <br/><br/>
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

            quill.setContents({!! $delta !!});

            const getCurrentDeltaJson = () => JSON.stringify(quill.getContents());
            let originalDeltaJson = getCurrentDeltaJson();
            const hasDeltaChanged = () => (getCurrentDeltaJson() !== originalDeltaJson);

            const enableSaveButton = () => {
                document.getElementById('ql-save-button').disabled = false;
                document.getElementById('ql-save-button-icon').setAttribute('stroke', 'blue');
            };

            const disableSaveButton = () => {
                document.getElementById('ql-save-button').disabled = true;
                document.getElementById('ql-save-button-icon').setAttribute('stroke', 'lightslategray');
            };

            quill.on('text-change', function() {
                hasDeltaChanged() ? enableSaveButton() : disableSaveButton();
            });

            document.getElementById('ql-save-button').addEventListener('click', function () {
                const currentDeltaJson = getCurrentDeltaJson();

                originalDeltaJson = currentDeltaJson;

                disableSaveButton();

                Livewire.emit(
                    'saveDelta',
                    currentDeltaJson,
                    {{ $prompt->id }}
                );
            });

            document.getElementById('ql-delete-drafts-button').addEventListener('click', function () {
                const shouldDeleteDrafts = confirm('Are you sure you want to delete this draft?');

                if (shouldDeleteDrafts) {
                    Livewire.emit(
                        'deleteDrafts',
                        {{ $prompt->id }}
                    );
                }
            });

            const confirmPromptText = 'Are you sure you want a new prompt?\nYou will lose any unsaved changes.';

            window.addEventListener('beforeunload', (event) => {
                if (event.target.activeElement.id !== 'ql-delete-drafts-button' && hasDeltaChanged()) {
                    event.returnValue = confirmPromptText;
                }
            });
        </script>
    </body>
</html>
