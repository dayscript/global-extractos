"use strict";
/**
 * @license
 * Copyright Google Inc. All Rights Reserved.
 *
 * Use of this source code is governed by an MIT-style license that can be
 * found in the LICENSE file at https://angular.io/license
 */
/**
 * Suppress closure compiler errors about unknown 'Zone' variable
 * @fileoverview
 * @suppress {undefinedVars,globalThis}
 */
Object.defineProperty(exports, "__esModule", { value: true });
exports.zoneSymbol = (n) => `__zone_symbol__${n}`;
const _global = typeof window === 'object' && window || typeof self === 'object' && self || global;
function bindArguments(args, source) {
    for (let i = args.length - 1; i >= 0; i--) {
        if (typeof args[i] === 'function') {
            args[i] = Zone.current.wrap(args[i], source + '_' + i);
        }
    }
    return args;
}
exports.bindArguments = bindArguments;
function patchPrototype(prototype, fnNames) {
    const source = prototype.constructor['name'];
    for (let i = 0; i < fnNames.length; i++) {
        const name = fnNames[i];
        const delegate = prototype[name];
        if (delegate) {
            prototype[name] = ((delegate) => {
                return function () {
                    return delegate.apply(this, bindArguments(arguments, source + '.' + name));
                };
            })(delegate);
        }
    }
}
exports.patchPrototype = patchPrototype;
exports.isWebWorker = (typeof WorkerGlobalScope !== 'undefined' && self instanceof WorkerGlobalScope);
exports.isNode = (!('nw' in _global) && typeof process !== 'undefined' &&
    {}.toString.call(process) === '[object process]');
exports.isBrowser = !exports.isNode && !exports.isWebWorker && !!(typeof window !== 'undefined' && window['HTMLElement']);
// we are in electron of nw, so we are both browser and nodejs
exports.isMix = typeof process !== 'undefined' &&
    {}.toString.call(process) === '[object process]' && !exports.isWebWorker &&
    !!(typeof window !== 'undefined' && window['HTMLElement']);
function patchProperty(obj, prop) {
    const desc = Object.getOwnPropertyDescriptor(obj, prop) || { enumerable: true, configurable: true };
    const originalDesc = Object.getOwnPropertyDescriptor(obj, 'original' + prop);
    if (!originalDesc && desc.get) {
        Object.defineProperty(obj, 'original' + prop, { enumerable: false, configurable: true, get: desc.get });
    }
    // A property descriptor cannot have getter/setter and be writable
    // deleting the writable and value properties avoids this error:
    //
    // TypeError: property descriptors must not specify a value or be writable when a
    // getter or setter has been specified
    delete desc.writable;
    delete desc.value;
    // substr(2) cuz 'onclick' -> 'click', etc
    const eventName = prop.substr(2);
    const _prop = exports.zoneSymbol('_' + prop);
    desc.set = function (fn) {
        if (this[_prop]) {
            this.removeEventListener(eventName, this[_prop]);
        }
        if (typeof fn === 'function') {
            const wrapFn = function (event) {
                let result;
                result = fn.apply(this, arguments);
                if (result != undefined && !result)
                    event.preventDefault();
            };
            this[_prop] = wrapFn;
            this.addEventListener(eventName, wrapFn, false);
        }
        else {
            this[_prop] = null;
        }
    };
    // The getter would return undefined for unassigned properties but the default value of an
    // unassigned property is null
    desc.get = function () {
        let r = this[_prop] || null;
        // result will be null when use inline event attribute,
        // such as <button onclick="func();">OK</button>
        // because the onclick function is internal raw uncompiled handler
        // the onclick will be evaluated when first time event was triggered or
        // the property is accessed, https://github.com/angular/zone.js/issues/525
        // so we should use original native get to retrieve the handler
        if (r === null) {
            if (originalDesc && originalDesc.get) {
                r = originalDesc.get.apply(this, arguments);
                if (r) {
                    desc.set.apply(this, [r]);
                    if (typeof this['removeAttribute'] === 'function') {
                        this.removeAttribute(prop);
                    }
                }
            }
        }
        return this[_prop] || null;
    };
    Object.defineProperty(obj, prop, desc);
}
exports.patchProperty = patchProperty;
;
function patchOnProperties(obj, properties) {
    const onProperties = [];
    for (const prop in obj) {
        if (prop.substr(0, 2) == 'on') {
            onProperties.push(prop);
        }
    }
    for (let j = 0; j < onProperties.length; j++) {
        patchProperty(obj, onProperties[j]);
    }
    if (properties) {
        for (let i = 0; i < properties.length; i++) {
            patchProperty(obj, 'on' + properties[i]);
        }
    }
}
exports.patchOnProperties = patchOnProperties;
;
const EVENT_TASKS = exports.zoneSymbol('eventTasks');
// For EventTarget
const ADD_EVENT_LISTENER = 'addEventListener';
const REMOVE_EVENT_LISTENER = 'removeEventListener';
function findExistingRegisteredTask(target, handler, name, capture, remove) {
    const eventTasks = target[EVENT_TASKS];
    if (eventTasks) {
        for (let i = 0; i < eventTasks.length; i++) {
            const eventTask = eventTasks[i];
            const data = eventTask.data;
            const listener = data.handler;
            if ((data.handler === handler || listener.listener === handler) &&
                data.useCapturing === capture && data.eventName === name) {
                if (remove) {
                    eventTasks.splice(i, 1);
                }
                return eventTask;
            }
        }
    }
    return null;
}
function findAllExistingRegisteredTasks(target, name, capture, remove) {
    const eventTasks = target[EVENT_TASKS];
    if (eventTasks) {
        const result = [];
        for (let i = eventTasks.length - 1; i >= 0; i--) {
            const eventTask = eventTasks[i];
            const data = eventTask.data;
            if (data.eventName === name && data.useCapturing === capture) {
                result.push(eventTask);
                if (remove) {
                    eventTasks.splice(i, 1);
                }
            }
        }
        return result;
    }
    return null;
}
function attachRegisteredEvent(target, eventTask, isPrepend) {
    let eventTasks = target[EVENT_TASKS];
    if (!eventTasks) {
        eventTasks = target[EVENT_TASKS] = [];
    }
    if (isPrepend) {
        eventTasks.unshift(eventTask);
    }
    else {
        eventTasks.push(eventTask);
    }
}
const defaultListenerMetaCreator = (self, args) => {
    return {
        useCapturing: args[2],
        eventName: args[0],
        handler: args[1],
        target: self || _global,
        name: args[0],
        invokeAddFunc: function (addFnSymbol, delegate) {
            if (delegate && delegate.invoke) {
                return this.target[addFnSymbol](this.eventName, delegate.invoke, this.useCapturing);
            }
            else {
                return this.target[addFnSymbol](this.eventName, delegate, this.useCapturing);
            }
        },
        invokeRemoveFunc: function (removeFnSymbol, delegate) {
            if (delegate && delegate.invoke) {
                return this.target[removeFnSymbol](this.eventName, delegate.invoke, this.useCapturing);
            }
            else {
                return this.target[removeFnSymbol](this.eventName, delegate, this.useCapturing);
            }
        }
    };
};
function makeZoneAwareAddListener(addFnName, removeFnName, useCapturingParam = true, allowDuplicates = false, isPrepend = false, metaCreator = defaultListenerMetaCreator) {
    const addFnSymbol = exports.zoneSymbol(addFnName);
    const removeFnSymbol = exports.zoneSymbol(removeFnName);
    const defaultUseCapturing = useCapturingParam ? false : undefined;
    function scheduleEventListener(eventTask) {
        const meta = eventTask.data;
        attachRegisteredEvent(meta.target, eventTask, isPrepend);
        return meta.invokeAddFunc(addFnSymbol, eventTask);
    }
    function cancelEventListener(eventTask) {
        const meta = eventTask.data;
        findExistingRegisteredTask(meta.target, eventTask.invoke, meta.eventName, meta.useCapturing, true);
        return meta.invokeRemoveFunc(removeFnSymbol, eventTask);
    }
    return function zoneAwareAddListener(self, args) {
        const data = metaCreator(self, args);
        data.useCapturing = data.useCapturing || defaultUseCapturing;
        // - Inside a Web Worker, `this` is undefined, the context is `global`
        // - When `addEventListener` is called on the global context in strict mode, `this` is undefined
        // see https://github.com/angular/zone.js/issues/190
        let delegate = null;
        if (typeof data.handler == 'function') {
            delegate = data.handler;
        }
        else if (data.handler && data.handler.handleEvent) {
            delegate = (event) => data.handler.handleEvent(event);
        }
        let validZoneHandler = false;
        try {
            // In cross site contexts (such as WebDriver frameworks like Selenium),
            // accessing the handler object here will cause an exception to be thrown which
            // will fail tests prematurely.
            validZoneHandler = data.handler && data.handler.toString() === '[object FunctionWrapper]';
        }
        catch (error) {
            // Returning nothing here is fine, because objects in a cross-site context are unusable
            return;
        }
        // Ignore special listeners of IE11 & Edge dev tools, see
        // https://github.com/angular/zone.js/issues/150
        if (!delegate || validZoneHandler) {
            return data.invokeAddFunc(addFnSymbol, data.handler);
        }
        if (!allowDuplicates) {
            const eventTask = findExistingRegisteredTask(data.target, data.handler, data.eventName, data.useCapturing, false);
            if (eventTask) {
                // we already registered, so this will have noop.
                return data.invokeAddFunc(addFnSymbol, eventTask);
            }
        }
        const zone = Zone.current;
        const source = data.target.constructor['name'] + '.' + addFnName + ':' + data.eventName;
        zone.scheduleEventTask(source, delegate, data, scheduleEventListener, cancelEventListener);
    };
}
exports.makeZoneAwareAddListener = makeZoneAwareAddListener;
function makeZoneAwareRemoveListener(fnName, useCapturingParam = true, metaCreator = defaultListenerMetaCreator) {
    const symbol = exports.zoneSymbol(fnName);
    const defaultUseCapturing = useCapturingParam ? false : undefined;
    return function zoneAwareRemoveListener(self, args) {
        const data = metaCreator(self, args);
        data.useCapturing = data.useCapturing || defaultUseCapturing;
        // - Inside a Web Worker, `this` is undefined, the context is `global`
        // - When `addEventListener` is called on the global context in strict mode, `this` is undefined
        // see https://github.com/angular/zone.js/issues/190
        const eventTask = findExistingRegisteredTask(data.target, data.handler, data.eventName, data.useCapturing, true);
        if (eventTask) {
            eventTask.zone.cancelTask(eventTask);
        }
        else {
            data.invokeRemoveFunc(symbol, data.handler);
        }
    };
}
exports.makeZoneAwareRemoveListener = makeZoneAwareRemoveListener;
function makeZoneAwareRemoveAllListeners(fnName, useCapturingParam = true) {
    const symbol = exports.zoneSymbol(fnName);
    const defaultUseCapturing = useCapturingParam ? false : undefined;
    return function zoneAwareRemoveAllListener(self, args) {
        const target = self || _global;
        if (args.length === 0) {
            // remove all listeners without eventName
            target[EVENT_TASKS] = [];
            // we don't cancel Task either, because call native eventEmitter.removeAllListeners will
            // will do remove listener(cancelTask) for us
            target[symbol]();
            return;
        }
        const eventName = args[0];
        const useCapturing = args[1] || defaultUseCapturing;
        // call this function just remove the related eventTask from target[EVENT_TASKS]
        findAllExistingRegisteredTasks(target, eventName, useCapturing, true);
        // we don't need useCapturing here because useCapturing is just for DOM, and
        // removeAllListeners should only be called by node eventEmitter
        // and we don't cancel Task either, because call native eventEmitter.removeAllListeners will
        // will do remove listener(cancelTask) for us
        target[symbol](eventName);
    };
}
exports.makeZoneAwareRemoveAllListeners = makeZoneAwareRemoveAllListeners;
function makeZoneAwareListeners(fnName) {
    const symbol = exports.zoneSymbol(fnName);
    return function zoneAwareEventListeners(self, args) {
        const eventName = args[0];
        const target = self || _global;
        if (!target[EVENT_TASKS]) {
            return [];
        }
        return target[EVENT_TASKS]
            .filter(task => task.data.eventName === eventName)
            .map(task => task.data.handler);
    };
}
exports.makeZoneAwareListeners = makeZoneAwareListeners;
const zoneAwareAddEventListener = makeZoneAwareAddListener(ADD_EVENT_LISTENER, REMOVE_EVENT_LISTENER);
const zoneAwareRemoveEventListener = makeZoneAwareRemoveListener(REMOVE_EVENT_LISTENER);
function patchEventTargetMethods(obj, addFnName = ADD_EVENT_LISTENER, removeFnName = REMOVE_EVENT_LISTENER, metaCreator = defaultListenerMetaCreator) {
    if (obj && obj[addFnName]) {
        patchMethod(obj, addFnName, () => makeZoneAwareAddListener(addFnName, removeFnName, true, false, false, metaCreator));
        patchMethod(obj, removeFnName, () => makeZoneAwareRemoveListener(removeFnName, true, metaCreator));
        return true;
    }
    else {
        return false;
    }
}
exports.patchEventTargetMethods = patchEventTargetMethods;
const originalInstanceKey = exports.zoneSymbol('originalInstance');
// wrap some native API on `window`
function patchClass(className) {
    const OriginalClass = _global[className];
    if (!OriginalClass)
        return;
    _global[className] = function () {
        const a = bindArguments(arguments, className);
        switch (a.length) {
            case 0:
                this[originalInstanceKey] = new OriginalClass();
                break;
            case 1:
                this[originalInstanceKey] = new OriginalClass(a[0]);
                break;
            case 2:
                this[originalInstanceKey] = new OriginalClass(a[0], a[1]);
                break;
            case 3:
                this[originalInstanceKey] = new OriginalClass(a[0], a[1], a[2]);
                break;
            case 4:
                this[originalInstanceKey] = new OriginalClass(a[0], a[1], a[2], a[3]);
                break;
            default:
                throw new Error('Arg list too long.');
        }
    };
    const instance = new OriginalClass(function () { });
    let prop;
    for (prop in instance) {
        // https://bugs.webkit.org/show_bug.cgi?id=44721
        if (className === 'XMLHttpRequest' && prop === 'responseBlob')
            continue;
        (function (prop) {
            if (typeof instance[prop] === 'function') {
                _global[className].prototype[prop] = function () {
                    return this[originalInstanceKey][prop].apply(this[originalInstanceKey], arguments);
                };
            }
            else {
                Object.defineProperty(_global[className].prototype, prop, {
                    set: function (fn) {
                        if (typeof fn === 'function') {
                            this[originalInstanceKey][prop] = Zone.current.wrap(fn, className + '.' + prop);
                        }
                        else {
                            this[originalInstanceKey][prop] = fn;
                        }
                    },
                    get: function () {
                        return this[originalInstanceKey][prop];
                    }
                });
            }
        }(prop));
    }
    for (prop in OriginalClass) {
        if (prop !== 'prototype' && OriginalClass.hasOwnProperty(prop)) {
            _global[className][prop] = OriginalClass[prop];
        }
    }
}
exports.patchClass = patchClass;
;
function createNamedFn(name, delegate) {
    try {
        return (Function('f', `return function ${name}(){return f(this, arguments)}`))(delegate);
    }
    catch (error) {
        // if we fail, we must be CSP, just return delegate.
        return function () {
            return delegate(this, arguments);
        };
    }
}
exports.createNamedFn = createNamedFn;
function patchMethod(target, name, patchFn) {
    let proto = target;
    while (proto && Object.getOwnPropertyNames(proto).indexOf(name) === -1) {
        proto = Object.getPrototypeOf(proto);
    }
    if (!proto && target[name]) {
        // somehow we did not find it, but we can see it. This happens on IE for Window properties.
        proto = target;
    }
    const delegateName = exports.zoneSymbol(name);
    let delegate;
    if (proto && !(delegate = proto[delegateName])) {
        delegate = proto[delegateName] = proto[name];
        proto[name] = createNamedFn(name, patchFn(delegate, delegateName, name));
    }
    return delegate;
}
exports.patchMethod = patchMethod;
// TODO: @JiaLiPassion, support cancel task later if necessary
function patchMacroTask(obj, funcName, metaCreator) {
    let setNative = null;
    function scheduleTask(task) {
        const data = task.data;
        data.args[data.callbackIndex] = function () {
            task.invoke.apply(this, arguments);
        };
        setNative.apply(data.target, data.args);
        return task;
    }
    setNative = patchMethod(obj, funcName, (delegate) => function (self, args) {
        const meta = metaCreator(self, args);
        if (meta.callbackIndex >= 0 && typeof args[meta.callbackIndex] === 'function') {
            const task = Zone.current.scheduleMacroTask(meta.name, args[meta.callbackIndex], meta, scheduleTask, null);
            return task;
        }
        else {
            // cause an error by calling it directly.
            return delegate.apply(self, args);
        }
    });
}
exports.patchMacroTask = patchMacroTask;
function patchMicroTask(obj, funcName, metaCreator) {
    let setNative = null;
    function scheduleTask(task) {
        const data = task.data;
        data.args[data.callbackIndex] = function () {
            task.invoke.apply(this, arguments);
        };
        setNative.apply(data.target, data.args);
        return task;
    }
    setNative = patchMethod(obj, funcName, (delegate) => function (self, args) {
        const meta = metaCreator(self, args);
        if (meta.callbackIndex >= 0 && typeof args[meta.callbackIndex] === 'function') {
            const task = Zone.current.scheduleMicroTask(meta.name, args[meta.callbackIndex], meta, scheduleTask);
            return task;
        }
        else {
            // cause an error by calling it directly.
            return delegate.apply(self, args);
        }
    });
}
exports.patchMicroTask = patchMicroTask;
function findEventTask(target, evtName) {
    const eventTasks = target[exports.zoneSymbol('eventTasks')];
    const result = [];
    if (eventTasks) {
        for (let i = 0; i < eventTasks.length; i++) {
            const eventTask = eventTasks[i];
            const data = eventTask.data;
            const eventName = data && data.eventName;
            if (eventName === evtName) {
                result.push(eventTask);
            }
        }
    }
    return result;
}
exports.findEventTask = findEventTask;
Zone[exports.zoneSymbol('patchEventTargetMethods')] = patchEventTargetMethods;
Zone[exports.zoneSymbol('patchOnProperties')] = patchOnProperties;
//# sourceMappingURL=utils.js.map