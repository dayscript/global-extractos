"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const Observable_1 = require("../../Observable");
const do_1 = require("../../operator/do");
Observable_1.Observable.prototype.do = do_1._do;
Observable_1.Observable.prototype._do = do_1._do;
//# sourceMappingURL=do.js.map