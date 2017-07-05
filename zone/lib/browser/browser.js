"use strict";
/**
 * @license
 * Copyright Google Inc. All Rights Reserved.
 *
 * Use of this source code is governed by an MIT-style license that can be
 * found in the LICENSE file at https://angular.io/license
 */
Object.defineProperty(exports, "__esModule", { value: true });
const timers_1 = require("../common/timers");
const utils_1 = require("../common/utils");
const define_property_1 = require("./define-property");
const event_target_1 = require("./event-target");
const property_descriptor_1 = require("./property-descriptor");
const register_element_1 = require("./register-element");
const set = 'set';
const clear = 'clear';
const blockingMethods = ['alert', 'prompt', 'confirm'];
const _global = typeof window === 'object' && window || typeof self === 'object' && self || global;
timers_1.patchTimer(_global, set, clear, 'Timeout');
timers_1.patchTimer(_global, set, clear, 'Interval');
timers_1.patchTimer(_global, set, clear, 'Immediate');
timers_1.patchTimer(_global, 'request', 'cancel', 'AnimationFrame');
timers_1.patchTimer(_global, 'mozRequest', 'mozCancel', 'AnimationFrame');
timers_1.patchTimer(_global, 'webkitRequest', 'webkitCancel', 'AnimationFrame');
for (let i = 0; i < blockingMethods.length; i++) {
    const name = blockingMethods[i];
    utils_1.patchMethod(_global, name, (delegate, symbol, name) => {
        return function (s, args) {
            return Zone.current.run(delegate, _global, args, name);
        };
    });
}
event_target_1.eventTargetPatch(_global);
property_descriptor_1.propertyDescriptorPatch(_global);
utils_1.patchClass('MutationObserver');
utils_1.patchClass('WebKitMutationObserver');
utils_1.patchClass('FileReader');
define_property_1.propertyPatch();
register_element_1.registerElementPatch(_global);
// Treat XMLHTTPRequest as a macrotask.
patchXHR(_global);
const XHR_TASK = utils_1.zoneSymbol('xhrTask');
const XHR_SYNC = utils_1.zoneSymbol('xhrSync');
const XHR_LISTENER = utils_1.zoneSymbol('xhrListener');
const XHR_SCHEDULED = utils_1.zoneSymbol('xhrScheduled');
function patchXHR(window) {
    function findPendingTask(target) {
        const pendingTask = target[XHR_TASK];
        return pendingTask;
    }
    function scheduleTask(task) {
        self[XHR_SCHEDULED] = false;
        const data = task.data;
        // remove existing event listener
        const listener = data.target[XHR_LISTENER];
        if (listener) {
            data.target.removeEventListener('readystatechange', listener);
        }
        const newListener = data.target[XHR_LISTENER] = () => {
            if (data.target.readyState === data.target.DONE) {
                // sometimes on some browsers XMLHttpRequest will fire onreadystatechange with
                // readyState=4 multiple times, so we need to check task state here
                if (!data.aborted && self[XHR_SCHEDULED] && task.state === 'scheduled') {
                    task.invoke();
                }
            }
        };
        data.target.addEventListener('readystatechange', newListener);
        const storedTask = data.target[XHR_TASK];
        if (!storedTask) {
            data.target[XHR_TASK] = task;
        }
        sendNative.apply(data.target, data.args);
        self[XHR_SCHEDULED] = true;
        return task;
    }
    function placeholderCallback() { }
    function clearTask(task) {
        const data = task.data;
        // Note - ideally, we would call data.target.removeEventListener here, but it's too late
        // to prevent it from firing. So instead, we store info for the event listener.
        data.aborted = true;
        return abortNative.apply(data.target, data.args);
    }
    const openNative = utils_1.patchMethod(window.XMLHttpRequest.prototype, 'open', () => function (self, args) {
        self[XHR_SYNC] = args[2] == false;
        return openNative.apply(self, args);
    });
    const sendNative = utils_1.patchMethod(window.XMLHttpRequest.prototype, 'send', () => function (self, args) {
        const zone = Zone.current;
        if (self[XHR_SYNC]) {
            // if the XHR is sync there is no task to schedule, just execute the code.
            return sendNative.apply(self, args);
        }
        else {
            const options = { target: self, isPeriodic: false, delay: null, args: args, aborted: false };
            return zone.scheduleMacroTask('XMLHttpRequest.send', placeholderCallback, options, scheduleTask, clearTask);
        }
    });
    const abortNative = utils_1.patchMethod(window.XMLHttpRequest.prototype, 'abort', (delegate) => function (self, args) {
        const task = findPendingTask(self);
        if (task && typeof task.type == 'string') {
            // If the XHR has already completed, do nothing.
            // If the XHR has already been aborted, do nothing.
            // Fix #569, call abort multiple times before done will cause
            // macroTask task count be negative number
            if (task.cancelFn == null || (task.data && task.data.aborted)) {
                return;
            }
            task.zone.cancelTask(task);
        }
        // Otherwise, we are trying to abort an XHR which has not yet been sent, so there is no task
        // to cancel. Do nothing.
    });
}
/// GEO_LOCATION
if (_global['navigator'] && _global['navigator'].geolocation) {
    utils_1.patchPrototype(_global['navigator'].geolocation, ['getCurrentPosition', 'watchPosition']);
}
// handle unhandled promise rejection
function findPromiseRejectionHandler(evtName) {
    return function (e) {
        const eventTasks = utils_1.findEventTask(_global, evtName);
        eventTasks.forEach(eventTask => {
            // windows has added unhandledrejection event listener
            // trigger the event listener
            const PromiseRejectionEvent = _global['PromiseRejectionEvent'];
            if (PromiseRejectionEvent) {
                const evt = new PromiseRejectionEvent(evtName, { promise: e.promise, reason: e.rejection });
                eventTask.invoke(evt);
            }
        });
    };
}
if (_global['PromiseRejectionEvent']) {
    Zone[utils_1.zoneSymbol('unhandledPromiseRejectionHandler')] =
        findPromiseRejectionHandler('unhandledrejection');
    Zone[utils_1.zoneSymbol('rejectionHandledHandler')] = findPromiseRejectionHandler('rejectionhandled');
}
//# sourceMappingURL=browser.js.map