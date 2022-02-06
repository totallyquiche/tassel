<x-app-layout>
    @push('css')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    <x-slot name="header">
        <a class="underline text-blue-200 hover:text-blue-400" href="{{ route('prompt.random') }}">Write Something.</a>
    </x-slot>

    <div id="overlay" class="fixed top-[-100%] left-0 right-0 bottom-0 w-full h-full z-50 cursor-pointer bg-cyan-900 opacity-[0.95]" style="transition: top 0.20s ease-in-out;');">
        <img class="max-h-full mx-auto" src="{{ asset('storage/images/logo-white.png') }}" />
    </div>

    <span class="text-slate-300">
        <span class="italic text-rose-200">Prompt:</span>

        {{ $prompt->text }}
    </span>

    <div id="toolbar" class="mt-8 bg-slate-100">
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
        <span class="ql-formats float-right">
            <button id="toggle-overlay-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="lightslategray">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
            @livewire('save-draft-button')
            @livewire('delete-drafts-button')
        </span>
    </div>

    <div class="text-slate-900 mt-4 mb-12 bg-slate-100 h-96 overflow-auto">
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

            const toggleOverlay = () => {
                const overlay = document.querySelector('#overlay');
                const top = overlay.style.top;

                overlay.style.top = ((!top || top === '-100%') ? 0 : '-100%');
            };

            document.addEventListener('keydown', event => {
                if (event.key && event.key === 'Escape') {
                    toggleOverlay();
                }
            });

            document.querySelector('#overlay').addEventListener('click',
                () => toggleOverlay()
            );

            document.querySelector('#toggle-overlay-button').addEventListener('click',
                () => toggleOverlay()
            );
        </script>
    @endpush
</x-app-layout>
