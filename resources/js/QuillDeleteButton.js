export default class QuillDeleteButton {
  constructor(elementName) {
    this.element = elementName;
    this.iconElement = elementName + ' > svg';
  }

  set element(elementName) {
    this._element = document.querySelector(elementName);
  }

  get element() {
    return this._element;
  }

  set iconElement(iconElementName) {
    this._iconElement = document.querySelector(iconElementName);
  }

  get iconElement() {
    return this._iconElement;
  }

  addEventListeners(deltaManager) {
    const element = this.element;

    window.addEventListener('beforeunload', function(event) {
        if (event.target.activeElement !== element && deltaManager.hasDeltaChanged()) {
            event.returnValue = 'Are you sure you want a new prompt?\nYou will lose any unsaved changes.';
        }
    });

    this.element.addEventListener('click', function () {
      const shouldDeleteDrafts = confirm('Are you sure you want to delete this draft?');
    
      if (shouldDeleteDrafts) {
          Livewire.emit('deleteDrafts');
      }
    });
  }
}