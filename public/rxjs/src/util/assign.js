"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const root_1 = require("./root");
const Object = root_1.root.Object;
if (typeof Object.assign != 'function') {
    (function () {
        Object.assign = function assignPolyfill(target, ...sources) {
            if (target === undefined || target === null) {
                throw new TypeError('cannot convert undefined or null to object');
            }
            const output = Object(target);
            const len = sources.length;
            for (let index = 0; index < len; index++) {
                let source = sources[index];
                if (source !== undefined && source !== null) {
                    for (let key in source) {
                        if (source.hasOwnProperty(key)) {
                            output[key] = source[key];
                        }
                    }
                }
            }
            return output;
        };
    })();
}
exports.assign = Object.assign;
//# sourceMappingURL=assign.js.map