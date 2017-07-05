"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const Subject_1 = require("./Subject");
const queue_1 = require("./scheduler/queue");
const observeOn_1 = require("./operator/observeOn");
/**
 * @class ReplaySubject<T>
 */
class ReplaySubject extends Subject_1.Subject {
    constructor(bufferSize = Number.POSITIVE_INFINITY, windowTime = Number.POSITIVE_INFINITY, scheduler) {
        super();
        this.scheduler = scheduler;
        this._events = [];
        this._bufferSize = bufferSize < 1 ? 1 : bufferSize;
        this._windowTime = windowTime < 1 ? 1 : windowTime;
    }
    next(value) {
        const now = this._getNow();
        this._events.push(new ReplayEvent(now, value));
        this._trimBufferThenGetEvents();
        super.next(value);
    }
    _subscribe(subscriber) {
        const _events = this._trimBufferThenGetEvents();
        const scheduler = this.scheduler;
        if (scheduler) {
            subscriber.add(subscriber = new observeOn_1.ObserveOnSubscriber(subscriber, scheduler));
        }
        const len = _events.length;
        for (let i = 0; i < len && !subscriber.closed; i++) {
            subscriber.next(_events[i].value);
        }
        return super._subscribe(subscriber);
    }
    _getNow() {
        return (this.scheduler || queue_1.queue).now();
    }
    _trimBufferThenGetEvents() {
        const now = this._getNow();
        const _bufferSize = this._bufferSize;
        const _windowTime = this._windowTime;
        const _events = this._events;
        let eventsCount = _events.length;
        let spliceCount = 0;
        // Trim events that fall out of the time window.
        // Start at the front of the list. Break early once
        // we encounter an event that falls within the window.
        while (spliceCount < eventsCount) {
            if ((now - _events[spliceCount].time) < _windowTime) {
                break;
            }
            spliceCount++;
        }
        if (eventsCount > _bufferSize) {
            spliceCount = Math.max(spliceCount, eventsCount - _bufferSize);
        }
        if (spliceCount > 0) {
            _events.splice(0, spliceCount);
        }
        return _events;
    }
}
exports.ReplaySubject = ReplaySubject;
class ReplayEvent {
    constructor(time, value) {
        this.time = time;
        this.value = value;
    }
}
//# sourceMappingURL=ReplaySubject.js.map