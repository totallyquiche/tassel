/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/DeltaManager.js":
/*!**************************************!*\
  !*** ./resources/js/DeltaManager.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ DeltaManager)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var DeltaManager = /*#__PURE__*/function () {
  function DeltaManager(quillInstance) {
    _classCallCheck(this, DeltaManager);

    this.quillInstance = quillInstance;
    this.originalJson = this.getCurrentJson();
  }

  _createClass(DeltaManager, [{
    key: "quillInstance",
    get: function get() {
      return this._quillInstance;
    },
    set: function set(quillInstance) {
      this._quillInstance = quillInstance;
    }
  }, {
    key: "originalJson",
    get: function get() {
      return this._originalJson;
    },
    set: function set(originalJson) {
      this._originalJson = originalJson;
    }
  }, {
    key: "getCurrentJson",
    value: function getCurrentJson() {
      return JSON.stringify(this.quillInstance.getContents());
    }
  }, {
    key: "hasDeltaChanged",
    value: function hasDeltaChanged() {
      return this.getCurrentJson() !== this.originalJson;
    }
  }]);

  return DeltaManager;
}();



/***/ }),

/***/ "./resources/js/Overlay.js":
/*!*********************************!*\
  !*** ./resources/js/Overlay.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Overlay)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var Overlay = /*#__PURE__*/function () {
  function Overlay(elementName, toggleElementName) {
    _classCallCheck(this, Overlay);

    this.element = elementName;
    this.toggleElement = toggleElementName;
  }

  _createClass(Overlay, [{
    key: "element",
    get: function get() {
      return this._element;
    },
    set: function set(elementName) {
      this._element = document.querySelector(elementName);
    }
  }, {
    key: "toggleElement",
    get: function get() {
      return this._toggleElement;
    },
    set: function set(toggleElementName) {
      this._toggleElement = document.querySelector(toggleElementName);
    }
  }, {
    key: "addEventListeners",
    value: function addEventListeners() {
      var toggle = this.toggle.bind(this);
      document.addEventListener('keydown', function (event) {
        if (event.key && event.key === 'Escape') {
          toggle();
        }
      });
      this.toggleElement.addEventListener('click', function (event) {
        toggle();
      });
      this.element.addEventListener('click', function (event) {
        toggle();
      });
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var top = this.element.style.top;
      this.element.style.top = !top || top === '-100%' ? 0 : '-100%';
    }
  }]);

  return Overlay;
}();



/***/ }),

/***/ "./resources/js/QuillDeleteButton.js":
/*!*******************************************!*\
  !*** ./resources/js/QuillDeleteButton.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ QuillDeleteButton)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var QuillDeleteButton = /*#__PURE__*/function () {
  function QuillDeleteButton(elementName) {
    _classCallCheck(this, QuillDeleteButton);

    this.element = elementName;
    this.iconElement = elementName + ' > svg';
  }

  _createClass(QuillDeleteButton, [{
    key: "element",
    get: function get() {
      return this._element;
    },
    set: function set(elementName) {
      this._element = document.querySelector(elementName);
    }
  }, {
    key: "iconElement",
    get: function get() {
      return this._iconElement;
    },
    set: function set(iconElementName) {
      this._iconElement = document.querySelector(iconElementName);
    }
  }, {
    key: "addEventListeners",
    value: function addEventListeners(deltaManager) {
      var element = this.element;
      window.addEventListener('beforeunload', function (event) {
        if (event.target.activeElement !== element && deltaManager.hasDeltaChanged()) {
          event.returnValue = 'Are you sure you want a new prompt?\nYou will lose any unsaved changes.';
        }
      });
      this.element.addEventListener('click', function () {
        var shouldDeleteDrafts = confirm('Are you sure you want to delete this draft?');

        if (shouldDeleteDrafts) {
          Livewire.emit('deleteDrafts');
        }
      });
    }
  }]);

  return QuillDeleteButton;
}();



/***/ }),

/***/ "./resources/js/QuillManager.js":
/*!**************************************!*\
  !*** ./resources/js/QuillManager.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ QuillManager)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var QuillManager = /*#__PURE__*/function () {
  function QuillManager(quillInstance) {
    _classCallCheck(this, QuillManager);

    this.quillInstance = quillInstance;
  }

  _createClass(QuillManager, [{
    key: "quillInstance",
    get: function get() {
      return this._quillInstance;
    },
    set: function set(quillInstance) {
      this._quillInstance = quillInstance;
    }
  }, {
    key: "addEventListeners",
    value: function addEventListeners(deltaManager, quillSaveButton) {
      this.quillInstance.on('text-change', function () {
        deltaManager.hasDeltaChanged() ? quillSaveButton.enable() : quillSaveButton.disable();
      });
    }
  }]);

  return QuillManager;
}();



/***/ }),

/***/ "./resources/js/QuillSaveButton.js":
/*!*****************************************!*\
  !*** ./resources/js/QuillSaveButton.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ QuillSaveButton)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var QuillSaveButton = /*#__PURE__*/function () {
  function QuillSaveButton(elementName) {
    _classCallCheck(this, QuillSaveButton);

    this.element = elementName;
    this.iconElement = elementName + ' > svg';
  }

  _createClass(QuillSaveButton, [{
    key: "element",
    get: function get() {
      return this._element;
    },
    set: function set(elementName) {
      this._element = document.querySelector(elementName);
    }
  }, {
    key: "iconElement",
    get: function get() {
      return this._iconElement;
    },
    set: function set(iconElementName) {
      this._iconElement = document.querySelector(iconElementName);
    }
  }, {
    key: "enable",
    value: function enable() {
      this.element.disabled = false;
      this.iconElement.setAttribute('stroke', 'blue');
    }
  }, {
    key: "disable",
    value: function disable() {
      this.element.disabled = true;
      this.iconElement.setAttribute('stroke', 'lightslategray');
    }
  }, {
    key: "addEventListeners",
    value: function addEventListeners(deltaManager) {
      var disable = this.disable.bind(this);
      this.element.addEventListener('click', function () {
        var currentDeltaJson = deltaManager.getCurrentJson();
        deltaManager.originalJson = currentDeltaJson;
        disable();
        Livewire.emit('saveDelta', currentDeltaJson);
      });
    }
  }]);

  return QuillSaveButton;
}();



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./resources/js/prompt.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _QuillManager__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./QuillManager */ "./resources/js/QuillManager.js");
/* harmony import */ var _DeltaManager__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DeltaManager */ "./resources/js/DeltaManager.js");
/* harmony import */ var _Overlay__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Overlay */ "./resources/js/Overlay.js");
/* harmony import */ var _QuillSaveButton__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./QuillSaveButton */ "./resources/js/QuillSaveButton.js");
/* harmony import */ var _QuillDeleteButton__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./QuillDeleteButton */ "./resources/js/QuillDeleteButton.js");





var quillManager = new _QuillManager__WEBPACK_IMPORTED_MODULE_0__["default"](quill);
var deltaManager = new _DeltaManager__WEBPACK_IMPORTED_MODULE_1__["default"](quill);
var overlay = new _Overlay__WEBPACK_IMPORTED_MODULE_2__["default"]('#overlay', '#toggle-overlay-button');
var quillSaveButton = new _QuillSaveButton__WEBPACK_IMPORTED_MODULE_3__["default"]('#ql-save-button');
var quillDeleteButton = new _QuillDeleteButton__WEBPACK_IMPORTED_MODULE_4__["default"]('#ql-delete-drafts-button');
quillManager.addEventListeners(deltaManager, quillSaveButton);
overlay.addEventListeners();
quillSaveButton.addEventListeners(deltaManager);
quillDeleteButton.addEventListeners(deltaManager);
})();

/******/ })()
;