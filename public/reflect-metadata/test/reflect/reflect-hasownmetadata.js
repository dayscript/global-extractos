"use strict";
// Reflect.hasOwnMetadata ( metadataKey, target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflecthasownmetadata--metadatakey-target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectHasOwnMetadataInvalidTarget() {
    assert.throws(() => Reflect.hasOwnMetadata("key", undefined, undefined), TypeError);
}
exports.ReflectHasOwnMetadataInvalidTarget = ReflectHasOwnMetadataInvalidTarget;
function ReflectHasOwnMetadataWithoutTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.hasOwnMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectHasOwnMetadataWithoutTargetKeyWhenNotDefined = ReflectHasOwnMetadataWithoutTargetKeyWhenNotDefined;
function ReflectHasOwnMetadataWithoutTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.hasOwnMetadata("key", obj, undefined);
    assert.equal(result, true);
}
exports.ReflectHasOwnMetadataWithoutTargetKeyWhenDefined = ReflectHasOwnMetadataWithoutTargetKeyWhenDefined;
function ReflectHasOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let result = Reflect.hasOwnMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectHasOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype = ReflectHasOwnMetadataWithoutTargetKeyWhenDefinedOnPrototype;
function ReflectHasOwnMetadataWithTargetKeyWhenNotDefined() {
    let obj = {};
    let result = Reflect.hasOwnMetadata("key", obj, "name");
    assert.equal(result, false);
}
exports.ReflectHasOwnMetadataWithTargetKeyWhenNotDefined = ReflectHasOwnMetadataWithTargetKeyWhenNotDefined;
function ReflectHasOwnMetadataWithTargetKeyWhenDefined() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, "name");
    let result = Reflect.hasOwnMetadata("key", obj, "name");
    assert.equal(result, true);
}
exports.ReflectHasOwnMetadataWithTargetKeyWhenDefined = ReflectHasOwnMetadataWithTargetKeyWhenDefined;
function ReflectHasOwnMetadataWithTargetKeyWhenDefinedOnPrototype() {
    let prototype = {};
    let obj = Object.create(prototype);
    Reflect.defineMetadata("key", "value", prototype, "name");
    let result = Reflect.hasOwnMetadata("key", obj, "name");
    assert.equal(result, false);
}
exports.ReflectHasOwnMetadataWithTargetKeyWhenDefinedOnPrototype = ReflectHasOwnMetadataWithTargetKeyWhenDefinedOnPrototype;
//# sourceMappingURL=reflect-hasownmetadata.js.map