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
        currentDeltaJson
    );
});

document.getElementById('ql-delete-drafts-button').addEventListener('click', function () {
    const shouldDeleteDrafts = confirm('Are you sure you want to delete this draft?');

    if (shouldDeleteDrafts) {
        Livewire.emit('deleteDrafts');
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
