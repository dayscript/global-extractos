"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const root_1 = require("./root");
const isArray_1 = require("./isArray");
const isPromise_1 = require("./isPromise");
const Observable_1 = require("../Observable");
const iterator_1 = require("../symbol/iterator");
const InnerSubscriber_1 = require("../InnerSubscriber");
const observable_1 = require("../symbol/observable");
function subscribeToResult(outerSubscriber, result, outerValue, outerIndex) {
    let destination = new InnerSubscriber_1.InnerSubscriber(outerSubscriber, outerValue, outerIndex);
    if (destination.closed) {
        return null;
    }
    if (result instanceof Observable_1.Observable) {
        if (result._isScalar) {
            destination.next(result.value);
            destination.complete();
            return null;
        }
        else {
            return result.subscribe(destination);
        }
    }
    if (isArray_1.isArray(result)) {
        for (let i = 0, len = result.length; i < len && !destination.closed; i++) {
            destination.next(result[i]);
        }
        if (!destination.closed) {
            destination.complete();
        }
    }
    else if (isPromise_1.isPromise(result)) {
        result.then((value) => {
            if (!destination.closed) {
                destination.next(value);
                destination.complete();
            }
        }, (err) => destination.error(err))
            .then(null, (err) => {
            // Escaping the Promise trap: globally throw unhandled errors
            root_1.root.setTimeout(() => { throw err; });
        });
        return destination;
    }
    else if (typeof result[iterator_1.$$iterator] === 'function') {
        const iterator = result[iterator_1.$$iterator]();
        do {
            let item = iterator.next();
            if (item.done) {
                destination.complete();
                break;
            }
            destination.next(item.value);
            if (destination.closed) {
                break;
            }
        } while (true);
    }
    else if (typeof result[observable_1.$$observable] === 'function') {
        const obs = result[observable_1.$$observable]();
        if (typeof obs.subscribe !== 'function') {
            destination.error(new Error('invalid observable'));
        }
        else {
            return obs.subscribe(new InnerSubscriber_1.InnerSubscriber(outerSubscriber, outerValue, outerIndex));
        }
    }
    else {
        destination.error(new TypeError('unknown type returned'));
    }
    return null;
}
exports.subscribeToResult = subscribeToResult;
//# sourceMappingURL=subscribeToResult.js.map