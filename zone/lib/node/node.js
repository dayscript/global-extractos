"use strict";
/**
 * @license
 * Copyright Google Inc. All Rights Reserved.
 *
 * Use of this source code is governed by an MIT-style license that can be
 * found in the LICENSE file at https://angular.io/license
 */
Object.defineProperty(exports, "__esModule", { value: true });
require("../zone");
require("./events");
require("./fs");
const timers_1 = require("../common/timers");
const utils_1 = require("../common/utils");
const set = 'set';
const clear = 'clear';
const _global = typeof window === 'object' && window || typeof self === 'object' && self || global;
// Timers
const timers = require('timers');
timers_1.patchTimer(timers, set, clear, 'Timeout');
timers_1.patchTimer(timers, set, clear, 'Interval');
timers_1.patchTimer(timers, set, clear, 'Immediate');
const shouldPatchGlobalTimers = global.setTimeout !== timers.setTimeout;
if (shouldPatchGlobalTimers) {
    timers_1.patchTimer(_global, set, clear, 'Timeout');
    timers_1.patchTimer(_global, set, clear, 'Interval');
    timers_1.patchTimer(_global, set, clear, 'Immediate');
}
// patch process related methods
patchProcess();
handleUnhandledPromiseRejection();
// Crypto
let crypto;
try {
    crypto = require('crypto');
}
catch (err) {
}
// use the generic patchMacroTask to patch crypto
if (crypto) {
    const methodNames = ['randomBytes', 'pbkdf2'];
    methodNames.forEach(name => {
        utils_1.patchMacroTask(crypto, name, (self, args) => {
            return {
                name: 'crypto.' + name,
                args: args,
                callbackIndex: (args.length > 0 && typeof args[args.length - 1] === 'function') ? args.length - 1 : -1,
                target: crypto
            };
        });
    });
}
function patchProcess() {
    // patch nextTick as microTask
    utils_1.patchMicroTask(process, 'nextTick', (self, args) => {
        return {
            name: 'process.nextTick',
            args: args,
            callbackIndex: (args.length > 0 && typeof args[0] === 'function') ? 0 : -1,
            target: process
        };
    });
}
// handle unhandled promise rejection
function findProcessPromiseRejectionHandler(evtName) {
    return function (e) {
        const eventTasks = utils_1.findEventTask(process, evtName);
        eventTasks.forEach(eventTask => {
            // process has added unhandledrejection event listener
            // trigger the event listener
            if (evtName === 'unhandledRejection') {
                eventTask.invoke(e.rejection, e.promise);
            }
            else if (evtName === 'rejectionHandled') {
                eventTask.invoke(e.promise);
            }
        });
    };
}
function handleUnhandledPromiseRejection() {
    Zone[utils_1.zoneSymbol('unhandledPromiseRejectionHandler')] =
        findProcessPromiseRejectionHandler('unhandledRejection');
    Zone[utils_1.zoneSymbol('rejectionHandledHandler')] =
        findProcessPromiseRejectionHandler('rejectionHandled');
}
//# sourceMappingURL=node.js.map