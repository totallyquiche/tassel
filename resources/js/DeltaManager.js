export default class DeltaManager {
  constructor(quillInstance) {
    this.quillInstance = quillInstance;
    this.originalJson = this.getCurrentJson();
  }

  set quillInstance(quillInstance) {
    this._quillInstance = quillInstance;
  }

  get quillInstance() {
    return this._quillInstance;
  }

  set originalJson(originalJson) {
    this._originalJson = originalJson;
  }

  get originalJson() {
    return this._originalJson;
  }

  getCurrentJson() {
    return JSON.stringify(this.quillInstance.getContents());
  }

  hasDeltaChanged() {
    return this.getCurrentJson() !== this.originalJson;
  }
}