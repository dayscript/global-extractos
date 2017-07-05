"use strict";
// Reflect.getOwnMetadata ( metadataKey, target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectgetownmetadata--metadatakey-target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectGetOwnMetadataInvalidTarget() {
    assert.throws(() => Reflect.getOwnMetadata("key", undefined, undefined), TypeError);
}
exports.ReflectGetOwnMetadataInvalidTarget = ReflectGetOwnMetadataInvalidTarget;
function ReflectGetOwnMetadataWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getOwnMetadata("key", obj, undefined);
    assert.equal(result, undefined);
}
exports.ReflectGetOwnMetadataWithoutTargetKeyWhenNotDefined = ReflectGetOwnMetadataWithoutTargetKeyWhenNotDefined;
function ReflectGetOwnMetadataWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.getOwnMetadata("key", obj, undefined);
    assert.equal(result, "value");
}
exports.ReflectGetOwnMetadataWithoutTargetKeyWhenDefined = ReflectGetOwnMetadataWithoutTargetKeyWhenDefined;
function ReflectGetOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.getOwnMetadata("key", obj, undefined);
    assert.equal(result, undefined);
}
exports.ReflectGetOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype = ReflectGetOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectGetOwnMetadataWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getOwnMetadata("key", obj, "name");
    assert.equal(result, undefined);
}
exports.ReflectGetOwnMetadataWithTargetKeyWhenNotDefined = ReflectGetOwnMetadataWithTargetKeyWhenNotDefined;
function ReflectGetOwnMetadataWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.getOwnMetadata("key", obj, "name");
    assert.equal(result, "value");
}
exports.ReflectGetOwnMetadataWithTargetKeyWhenDefined = ReflectGetOwnMetadataWithTargetKeyWhenDefined;
function ReflectGetOwnMetadataWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.getOwnMetadata("key", obj, "name");
    assert.equal(result, undefined);
}
exports.ReflectGetOwnMetadataWithTargetKeyWhenDefinedOnPrototype = ReflectGetOwnMetadataWithTargetKeyWhenDefinedOnPrototype;
//# sourceMappingURL=reflect-getownmetadata.js.map