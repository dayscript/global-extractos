"use strict";
// Reflect.hasMetadata ( metadataKey, target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflecthasmetadata--metadatakey-target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectHasMetadataInvalidTarget() {
    assert.throws(() => Reflect.hasMetadata("key", undefined, undefined), TypeError);
}
exports.ReflectHasMetadataInvalidTarget = ReflectHasMetadataInvalidTarget;
function ReflectHasMetadataWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.hasMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectHasMetadataWithoutTargetKeyWhenNotDefined = ReflectHasMetadataWithoutTargetKeyWhenNotDefined;
function ReflectHasMetadataWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.hasMetadata("key", obj, undefined);
    assert.equal(result, true);
}
exports.ReflectHasMetadataWithoutTargetKeyWhenDefined = ReflectHasMetadataWithoutTargetKeyWhenDefined;
function ReflectHasMetadataWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.hasMetadata("key", obj, undefined);
    assert.equal(result, true);
}
exports.ReflectHasMetadataWithoutTargetKeyWhenDefinedOnPrototype = ReflectHasMetadataWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectHasMetadataWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.hasMetadata("key", obj, "name");
    assert.equal(result, false);
}
exports.ReflectHasMetadataWithTargetKeyWhenNotDefined = ReflectHasMetadataWithTargetKeyWhenNotDefined;
function ReflectHasMetadataWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.hasMetadata("key", obj, "name");
    assert.equal(result, true);
}
exports.ReflectHasMetadataWithTargetKeyWhenDefined = ReflectHasMetadataWithTargetKeyWhenDefined;
function ReflectHasMetadataWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.hasMetadata("key", obj, "name");
    assert.equal(result, true);
}
exports.ReflectHasMetadataWithTargetKeyWhenDefinedOnPrototype = ReflectHasMetadataWithTargetKeyWhenDefinedOnPrototype;
//# sourceMappingURL=reflect-hasmetadata.js.map