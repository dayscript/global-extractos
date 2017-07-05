"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
/**
 * An error thrown when an Observable or a sequence was queried but has no
 * elements.
 *
 * @see {@link first}
 * @see {@link last}
 * @see {@link single}
 *
 * @class EmptyError
 */
class EmptyError extends Error {
    constructor() {
        const err = super('no elements in sequence');
        this.name = err.name = 'EmptyError';
        this.stack = err.stack;
        this.message = err.message;
    }
}
exports.EmptyError = EmptyError;
//# sourceMappingURL=EmptyError.js.map