import QuillManager from './QuillManager';
import DeltaManager from './DeltaManager';
import Overlay from './Overlay';
import QuillSaveButton from './QuillSaveButton';
import QuillDeleteButton from './QuillDeleteButton';

const quillManager = new QuillManager(quill)
const deltaManager = new DeltaManager(quill);
const overlay = new Overlay('#overlay', '#toggle-overlay-button');
const quillSaveButton = new QuillSaveButton('#ql-save-button');
const quillDeleteButton = new QuillDeleteButton('#ql-delete-drafts-button');

quillManager.addEventListeners(deltaManager, quillSaveButton);
overlay.addEventListeners();
quillSaveButton.addEventListeners(deltaManager);
quillDeleteButton.addEventListeners(deltaManager);