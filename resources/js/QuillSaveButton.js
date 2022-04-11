export default class QuillSaveButton {
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

  enable() {
    this.element.disabled = false;
    this.iconElement.setAttribute('stroke', 'blue');
  }

  disable() {
    this.element.disabled = true;
    this.iconElement.setAttribute('stroke', 'lightslategray');
  }

  addEventListeners(deltaManager) {
    const disable = this.disable.bind(this);

    this.element.addEventListener('click', function () {
      const currentDeltaJson = deltaManager.getCurrentJson();
    
      deltaManager.originalJson = currentDeltaJson;
    
      disable();
    
      Livewire.emit(
          'saveDelta',
          currentDeltaJson
      );
    });
  }
}