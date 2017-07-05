"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const Observable_1 = require("../../Observable");
const catch_1 = require("../../operator/catch");
Observable_1.Observable.prototype.catch = catch_1._catch;
Observable_1.Observable.prototype._catch = catch_1._catch;
//# sourceMappingURL=catch.js.map