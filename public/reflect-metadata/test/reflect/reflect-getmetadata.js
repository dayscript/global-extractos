"use strict";
// Reflect.getMetadata ( metadataKey, target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectgetmetadata--metadatakey-target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectGetMetadataInvalidTarget() {
    assert.throws(() => Reflect.getMetadata("key", undefined, undefined), TypeError);
}
exports.ReflectGetMetadataInvalidTarget = ReflectGetMetadataInvalidTarget;
function ReflectGetMetadataWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getMetadata("key", obj, undefined);
    assert.equal(result, undefined);
}
exports.ReflectGetMetadataWithoutTargetKeyWhenNotDefined = ReflectGetMetadataWithoutTargetKeyWhenNotDefined;
function ReflectGetMetadataWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.getMetadata("key", obj, undefined);
    assert.equal(result, "value");
}
exports.ReflectGetMetadataWithoutTargetKeyWhenDefined = ReflectGetMetadataWithoutTargetKeyWhenDefined;
function ReflectGetMetadataWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.getMetadata("key", obj, undefined);
    assert.equal(result, "value");
}
exports.ReflectGetMetadataWithoutTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectGetMetadataWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.getMetadata("key", obj, "name");
    assert.equal(result, undefined);
}
exports.ReflectGetMetadataWithTargetKeyWhenNotDefined = ReflectGetMetadataWithTargetKeyWhenNotDefined;
function ReflectGetMetadataWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.getMetadata("key", obj, "name");
    assert.equal(result, "value");
}
exports.ReflectGetMetadataWithTargetKeyWhenDefined = ReflectGetMetadataWithTargetKeyWhenDefined;
function ReflectGetMetadataWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.getMetadata("key", obj, "name");
    assert.equal(result, "value");
}
exports.ReflectGetMetadataWithTargetKeyWhenDefinedOnPrototype = ReflectGetMetadataWithTargetKeyWhenDefinedOnPrototype;
//# sourceMappingURL=reflect-getmetadata.js.map