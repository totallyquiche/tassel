export default class QuillManager {
  constructor(quillInstance) {
    this.quillInstance = quillInstance;
  }

  set quillInstance(quillInstance) {
    this._quillInstance = quillInstance;
  }

  get quillInstance() {
    return this._quillInstance;
  }

  addEventListeners(deltaManager, quillSaveButton) {
    this.quillInstance.on('text-change', function() {
      deltaManager.hasDeltaChanged() ? quillSaveButton.enable() : quillSaveButton.disable();
    });
  }
}