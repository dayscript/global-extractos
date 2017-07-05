"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const Observable_1 = require("../Observable");
const ConnectableObservable_1 = require("../observable/ConnectableObservable");
class MulticastObservable extends Observable_1.Observable {
    constructor(source, subjectFactory, selector) {
        super();
        this.source = source;
        this.subjectFactory = subjectFactory;
        this.selector = selector;
    }
    _subscribe(subscriber) {
        const { selector, source } = this;
        const connectable = new ConnectableObservable_1.ConnectableObservable(source, this.subjectFactory);
        const subscription = selector(connectable).subscribe(subscriber);
        subscription.add(connectable.connect());
        return subscription;
    }
}
exports.MulticastObservable = MulticastObservable;
//# sourceMappingURL=MulticastObservable.js.map