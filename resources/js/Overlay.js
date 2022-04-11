export default class Overlay {
  constructor(elementName, toggleElementName) {
    this.element = elementName;
    this.toggleElement = toggleElementName;
  }

  set element(elementName) {
    this._element = document.querySelector(elementName);
  }

  get element() {
    return this._element;
  }

  set toggleElement(toggleElementName) {
    this._toggleElement = document.querySelector(toggleElementName);
  }

  get toggleElement() {
    return this._toggleElement;
  }

  addEventListeners() {
    const toggle = this.toggle.bind(this);

    document.addEventListener('keydown', function(event) {
      if (event.key && event.key === 'Escape') {
          toggle();
      }
    });

    this.toggleElement.addEventListener('click', function(event) {
      toggle();
    });

    this.element.addEventListener('click', function(event) {
      toggle();
    });
  }

  toggle() {
    const top = this.element.style.top;

    this.element.style.top = ((!top || top === '-100%') ? 0 : '-100%');
  }
}