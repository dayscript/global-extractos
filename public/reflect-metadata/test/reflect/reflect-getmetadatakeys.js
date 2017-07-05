"use strict";
// Reflect.getMetadataKeys ( target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectgetmetadatakeys--target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectGetMetadataKeysInvalidTarget() {
    // 1. If Type(target) is not Object, throw a TypeError exception.
    assert.throws(() => Reflect.getMetadataKeys(undefined, undefined), TypeError);
}
exports.ReflectGetMetadataKeysInvalidTarget = ReflectGetMetadataKeysInvalidTarget;
function ReflectGetMetadataKeysWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, []);
}
exports.ReflectGetMetadataKeysWithoutTargetKeyWhenNotDefined = ReflectGetMetadataKeysWithoutTargetKeyWhenNotDefined;
function ReflectGetMetadataKeysWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetMetadataKeysWithoutTargetKeyWhenDefined = ReflectGetMetadataKeysWithoutTargetKeyWhenDefined;
function ReflectGetMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectGetMetadataKeysOrderWithoutTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, undefined);
    Reflect.defineMetadata("key0", "value", obj, undefined);
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetMetadataKeysOrderWithoutTargetKey = ReflectGetMetadataKeysOrderWithoutTargetKey;
function ReflectGetMetadataKeysOrderAfterRedefineWithoutTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, undefined);
    Reflect.defineMetadata("key0", "value", obj, undefined);
    Reflect.defineMetadata("key1", "value", obj, undefined);
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetMetadataKeysOrderAfterRedefineWithoutTargetKey = ReflectGetMetadataKeysOrderAfterRedefineWithoutTargetKey;
function ReflectGetMetadataKeysOrderWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    Reflect.defineMetadata("key2", "value", prototype, undefined);
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key1", "value", obj, undefined);
    Reflect.defineMetadata("key0", "value", obj, undefined);
    let result = Reflect.getMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key1", "key0", "key2"]);
}
exports.ReflectGetMetadataKeysOrderWithoutTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataKeysOrderWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectGetMetadataKeysWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getMetadataKeys(obj, "name");
    assert.deepEqual(result, []);
}
exports.ReflectGetMetadataKeysWithTargetKeyWhenNotDefined = ReflectGetMetadataKeysWithTargetKeyWhenNotDefined;
function ReflectGetMetadataKeysWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.getMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetMetadataKeysWithTargetKeyWhenDefined = ReflectGetMetadataKeysWithTargetKeyWhenDefined;
function ReflectGetMetadataKeysWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.getMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetMetadataKeysWithTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataKeysWithTargetKeyWhenDefinedOnPrototype;
function ReflectGetMetadataKeysOrderAfterRedefineWithTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, "name");
    Reflect.defineMetadata("key0", "value", obj, "name");
    Reflect.defineMetadata("key1", "value", obj, "name");
    let result = Reflect.getMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetMetadataKeysOrderAfterRedefineWithTargetKey = ReflectGetMetadataKeysOrderAfterRedefineWithTargetKey;
function ReflectGetMetadataKeysOrderWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    Reflect.defineMetadata("key2", "value", prototype, "name");
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key1", "value", obj, "name");
    Reflect.defineMetadata("key0", "value", obj, "name");
    let result = Reflect.getMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key1", "key0", "key2"]);
}
exports.ReflectGetMetadataKeysOrderWithTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataKeysOrderWithTargetKeyWhenDefinedOnPrototype;
//# sourceMappingURL=reflect-getmetadatakeys.js.map