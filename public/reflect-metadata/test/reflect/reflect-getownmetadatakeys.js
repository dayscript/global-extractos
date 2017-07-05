"use strict";
// Reflect.getOwnMetadataKeysKeys ( target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectgetownmetadatakeyskeys--target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectGetOwnMetadataKeysKeysInvalidTarget() {
    // 1. If Type(target) is not Object, throw a TypeError exception.
    assert.throws(() => Reflect.getOwnMetadataKeys(undefined, undefined), TypeError);
}
exports.ReflectGetOwnMetadataKeysKeysInvalidTarget = ReflectGetOwnMetadataKeysKeysInvalidTarget;
function ReflectGetOwnMetadataKeysWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getOwnMetadataKeys(obj, undefined);
    assert.deepEqual(result, []);
}
exports.ReflectGetOwnMetadataKeysWithoutTargetKeyWhenNotDefined = ReflectGetOwnMetadataKeysWithoutTargetKeyWhenNotDefined;
function ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.getOwnMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefined = ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefined;
function ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.getOwnMetadataKeys(obj, undefined);
    assert.deepEqual(result, []);
}
exports.ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype = ReflectGetOwnMetadataKeysWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectGetOwnMetadataKeysOrderWithoutTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, undefined);
    Reflect.defineMetadata("key0", "value", obj, undefined);
    let result = Reflect.getOwnMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetOwnMetadataKeysOrderWithoutTargetKey = ReflectGetOwnMetadataKeysOrderWithoutTargetKey;
function ReflectGetOwnMetadataKeysOrderAfterRedefineWithoutTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, undefined);
    Reflect.defineMetadata("key0", "value", obj, undefined);
    Reflect.defineMetadata("key1", "value", obj, undefined);
    let result = Reflect.getOwnMetadataKeys(obj, undefined);
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetOwnMetadataKeysOrderAfterRedefineWithoutTargetKey = ReflectGetOwnMetadataKeysOrderAfterRedefineWithoutTargetKey;
function ReflectGetOwnMetadataKeysWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getOwnMetadataKeys(obj, "name");
    assert.deepEqual(result, []);
}
exports.ReflectGetOwnMetadataKeysWithTargetKeyWhenNotDefined = ReflectGetOwnMetadataKeysWithTargetKeyWhenNotDefined;
function ReflectGetOwnMetadataKeysWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.getOwnMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key"]);
}
exports.ReflectGetOwnMetadataKeysWithTargetKeyWhenDefined = ReflectGetOwnMetadataKeysWithTargetKeyWhenDefined;
function ReflectGetOwnMetadataKeysWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.getOwnMetadataKeys(obj, "name");
    assert.deepEqual(result, []);
}
exports.ReflectGetOwnMetadataKeysWithTargetKeyWhenDefinedOnPrototype = ReflectGetOwnMetadataKeysWithTargetKeyWhenDefinedOnPrototype;
function ReflectGetOwnMetadataKeysOrderAfterRedefineWithTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key1", "value", obj, "name");
    Reflect.defineMetadata("key0", "value", obj, "name");
    Reflect.defineMetadata("key1", "value", obj, "name");
    let result = Reflect.getOwnMetadataKeys(obj, "name");
    assert.deepEqual(result, ["key1", "key0"]);
}
exports.ReflectGetOwnMetadataKeysOrderAfterRedefineWithTargetKey = ReflectGetOwnMetadataKeysOrderAfterRedefineWithTargetKey;
//# sourceMappingURL=reflect-getownmetadatakeys.js.map