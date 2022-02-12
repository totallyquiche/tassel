/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/prompt.js ***!
  \********************************/
var getCurrentDeltaJson = function getCurrentDeltaJson() {
  return JSON.stringify(quill.getContents());
};

var originalDeltaJson = getCurrentDeltaJson();

var hasDeltaChanged = function hasDeltaChanged() {
  return getCurrentDeltaJson() !== originalDeltaJson;
};

var enableSaveButton = function enableSaveButton() {
  document.getElementById('ql-save-button').disabled = false;
  document.getElementById('ql-save-button-icon').setAttribute('stroke', 'blue');
};

var disableSaveButton = function disableSaveButton() {
  document.getElementById('ql-save-button').disabled = true;
  document.getElementById('ql-save-button-icon').setAttribute('stroke', 'lightslategray');
};

quill.on('text-change', function () {
  hasDeltaChanged() ? enableSaveButton() : disableSaveButton();
});
document.getElementById('ql-save-button').addEventListener('click', function () {
  var currentDeltaJson = getCurrentDeltaJson();
  originalDeltaJson = currentDeltaJson;
  disableSaveButton();
  Livewire.emit('saveDelta', currentDeltaJson);
});
document.getElementById('ql-delete-drafts-button').addEventListener('click', function () {
  var shouldDeleteDrafts = confirm('Are you sure you want to delete this draft?');

  if (shouldDeleteDrafts) {
    Livewire.emit('deleteDrafts');
  }
});
var confirmPromptText = 'Are you sure you want a new prompt?\nYou will lose any unsaved changes.';
window.addEventListener('beforeunload', function (event) {
  if (event.target.activeElement.id !== 'ql-delete-drafts-button' && hasDeltaChanged()) {
    event.returnValue = confirmPromptText;
  }
});

var toggleOverlay = function toggleOverlay() {
  var overlay = document.querySelector('#overlay');
  var top = overlay.style.top;
  overlay.style.top = !top || top === '-100%' ? 0 : '-100%';
};

document.addEventListener('keydown', function (event) {
  if (event.key && event.key === 'Escape') {
    toggleOverlay();
  }
});
document.querySelector('#overlay').addEventListener('click', function () {
  return toggleOverlay();
});
document.querySelector('#toggle-overlay-button').addEventListener('click', function () {
  return toggleOverlay();
});
/******/ })()
;