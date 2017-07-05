/**
 * @license
 * Copyright Google Inc. All Rights Reserved.
 *
 * Use of this source code is governed by an MIT-style license that can be
 * found in the LICENSE file at https://angular.io/license
 */
/**
 * @fileoverview
 * @suppress {globalThis}
 */
const NEWLINE = '\n';
const SEP = '  -------------  ';
const IGNORE_FRAMES = [];
const creationTrace = '__creationTrace__';
class LongStackTrace {
    constructor() {
        this.error = getStacktrace();
        this.timestamp = new Date();
    }
}
function getStacktraceWithUncaughtError() {
    return new Error('STACKTRACE TRACKING');
}
function getStacktraceWithCaughtError() {
    try {
        throw getStacktraceWithUncaughtError();
    }
    catch (err) {
        return err;
    }
}
// Some implementations of exception handling don't create a stack trace if the exception
// isn't thrown, however it's faster not to actually throw the exception.
const error = getStacktraceWithUncaughtError();
const caughtError = getStacktraceWithCaughtError();
const getStacktrace = error.stack ?
    getStacktraceWithUncaughtError :
    (caughtError.stack ? getStacktraceWithCaughtError : getStacktraceWithUncaughtError);
function getFrames(error) {
    return error.stack ? error.stack.split(NEWLINE) : [];
}
function addErrorStack(lines, error) {
    let trace = getFrames(error);
    for (let i = 0; i < trace.length; i++) {
        const frame = trace[i];
        // Filter out the Frames which are part of stack capturing.
        if (!(i < IGNORE_FRAMES.length && IGNORE_FRAMES[i] === frame)) {
            lines.push(trace[i]);
        }
    }
}
function renderLongStackTrace(frames, stack) {
    const longTrace = [stack];
    if (frames) {
        let timestamp = new Date().getTime();
        for (let i = 0; i < frames.length; i++) {
            const traceFrames = frames[i];
            const lastTime = traceFrames.timestamp;
            longTrace.push(`${SEP} Elapsed: ${timestamp - lastTime.getTime()} ms; At: ${lastTime} ${SEP}`);
            addErrorStack(longTrace, traceFrames.error);
            timestamp = lastTime.getTime();
        }
    }
    return longTrace.join(NEWLINE);
}
Zone['longStackTraceZoneSpec'] = {
    name: 'long-stack-trace',
    longStackTraceLimit: 10,
    // add a getLongStackTrace method in spec to
    // handle handled reject promise error.
    getLongStackTrace: function (error) {
        if (!error) {
            return undefined;
        }
        const task = error[Zone['__symbol__']('currentTask')];
        const trace = task && task.data && task.data[creationTrace];
        if (!trace) {
            return error.stack;
        }
        return renderLongStackTrace(trace, error.stack);
    },
    onScheduleTask: function (parentZoneDelegate, currentZone, targetZone, task) {
        const currentTask = Zone.currentTask;
        let trace = currentTask && currentTask.data && currentTask.data[creationTrace] || [];
        trace = [new LongStackTrace()].concat(trace);
        if (trace.length > this.longStackTraceLimit) {
            trace.length = this.longStackTraceLimit;
        }
        if (!task.data)
            task.data = {};
        task.data[creationTrace] = trace;
        return parentZoneDelegate.scheduleTask(targetZone, task);
    },
    onHandleError: function (parentZoneDelegate, currentZone, targetZone, error) {
        const parentTask = Zone.currentTask || error.task;
        if (error instanceof Error && parentTask) {
            let stackSetSucceeded = null;
            try {
                let descriptor = Object.getOwnPropertyDescriptor(error, 'stack');
                if (descriptor && descriptor.configurable) {
                    const delegateGet = descriptor.get;
                    const value = descriptor.value;
                    descriptor = {
                        get: function () {
                            return renderLongStackTrace(parentTask.data && parentTask.data[creationTrace], delegateGet ? delegateGet.apply(this) : value);
                        }
                    };
                    Object.defineProperty(error, 'stack', descriptor);
                    stackSetSucceeded = true;
                }
            }
            catch (err) {
            }
            const longStack = stackSetSucceeded ?
                null :
                renderLongStackTrace(parentTask.data && parentTask.data[creationTrace], error.stack);
            if (!stackSetSucceeded) {
                try {
                    stackSetSucceeded = error.stack = longStack;
                }
                catch (err) {
                }
            }
            if (!stackSetSucceeded) {
                try {
                    stackSetSucceeded = error.longStack = longStack;
                }
                catch (err) {
                }
            }
        }
        return parentZoneDelegate.handleError(targetZone, error);
    }
};
function captureStackTraces(stackTraces, count) {
    if (count > 0) {
        stackTraces.push(getFrames((new LongStackTrace()).error));
        captureStackTraces(stackTraces, count - 1);
    }
}
function computeIgnoreFrames() {
    const frames = [];
    captureStackTraces(frames, 2);
    const frames1 = frames[0];
    const frames2 = frames[1];
    for (let i = 0; i < frames1.length; i++) {
        const frame1 = frames1[i];
        const frame2 = frames2[i];
        if (frame1 === frame2) {
            IGNORE_FRAMES.push(frame1);
        }
        else {
            break;
        }
    }
}
computeIgnoreFrames();
//# sourceMappingURL=long-stack-trace.js.map