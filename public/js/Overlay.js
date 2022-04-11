/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
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
/*!*********************************!*\
  !*** ./resources/js/Overlay.js ***!
  \*********************************/
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


/******/ })()
;