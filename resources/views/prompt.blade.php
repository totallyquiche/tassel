<x-app-layout>
    @push('css')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    <x-slot name="header">
        <a class="underline text-blue-200 hover:text-blue-400" href="{{ route('prompt.random') }}">Write Something.</a>
    </x-slot>

    <div id="overlay" class="fixed top-0 left-0 right-0 bottom-0 w-full h-full z-50 cursor-pointer bg-cyan-900 opacity-[0.95]" style="transition: top 0.20s ease-in-out;');">
        <img class="max-h-full mx-auto" src="{{ asset('storage/images/logo-white.png') }}" />
    </div>

    <span>
        <span class="italic text-rose-200">Prompt:</span>

        {{ $prompt->text }}
    </span>

    <div id="toolbar" class="mt-8 bg-slate-200">
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

    <div class="text-slate-800 mt-4 mb-12 bg-slate-200 h-96 overflow-auto">
        <div id="editor"></div>
    </div>

    <section>
        <h2 class="text-center text-3xl my-12 text-rose-100">Drafts</h2>

        @livewire('draft-cards')
    </section>

    <br/><br/>

    @push('js')
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

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    const overlay = document.querySelector('#overlay');
                    const top = overlay.style.top;

                    overlay.style.top = ((!top || top === '0px') ? '-100%' : 0);
                }
            });

            document.querySelector('#overlay').addEventListener('click', function(event) {
                this.style.top = '-100%';
            });
        </script>
    @endpush
</x-app-layout>
