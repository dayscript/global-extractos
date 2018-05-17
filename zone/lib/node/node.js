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
var timers_1 = require("../common/timers");
var utils_1 = require("../common/utils");
var set = 'set';
var clear = 'clear';
var _global = typeof window === 'object' && window || typeof self === 'object' && self || global;
// Timers
var timers = require('timers');
timers_1.patchTimer(timers, set, clear, 'Timeout');
timers_1.patchTimer(timers, set, clear, 'Interval');
timers_1.patchTimer(timers, set, clear, 'Immediate');
var shouldPatchGlobalTimers = global.setTimeout !== timers.setTimeout;
if (shouldPatchGlobalTimers) {
    timers_1.patchTimer(_global, set, clear, 'Timeout');
    timers_1.patchTimer(_global, set, clear, 'Interval');
    timers_1.patchTimer(_global, set, clear, 'Immediate');
}
// patch process related methods
patchProcess();
handleUnhandledPromiseRejection();
// Crypto
var crypto;
try {
    crypto = require('crypto');
}
catch (err) {
}
// use the generic patchMacroTask to patch crypto
if (crypto) {
    var methodNames = ['randomBytes', 'pbkdf2'];
    methodNames.forEach(function (name) {
        utils_1.patchMacroTask(crypto, name, function (self, args) {
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
    utils_1.patchMicroTask(process, 'nextTick', function (self, args) {
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
        var eventTasks = utils_1.findEventTask(process, evtName);
        eventTasks.forEach(function (eventTask) {
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