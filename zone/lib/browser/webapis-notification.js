/**
 * @license
 * Copyright Google Inc. All Rights Reserved.
 *
 * Use of this source code is governed by an MIT-style license that can be
 * found in the LICENSE file at https://angular.io/license
 */
((_global) => {
    // patch Notification
    patchNotification(_global);
    function patchNotification(_global) {
        const Notification = _global['Notification'];
        if (!Notification || !Notification.prototype) {
            return;
        }
        const desc = Object.getOwnPropertyDescriptor(Notification.prototype, 'onerror');
        if (!desc || !desc.configurable) {
            return;
        }
        const patchOnProperties = Zone[Zone['__symbol__']('patchOnProperties')];
        patchOnProperties(Notification.prototype, null);
    }
})(typeof window === 'object' && window || typeof self === 'object' && self || global);
//# sourceMappingURL=webapis-notification.js.map