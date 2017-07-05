"use strict";
// Reflect.deleteMetadata ( metadataKey, target [, propertyKey] )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectdeletemetadata--metadatakey-target--propertykey-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectDeleteMetadataInvalidTarget() {
    assert.throws(() => Reflect.deleteMetadata("key", undefined, undefined), TypeError);
}
exports.ReflectDeleteMetadataInvalidTarget = ReflectDeleteMetadataInvalidTarget;
function ReflectDeleteMetadataWhenNotDefinedWithoutTargetKey() {
    let obj = {};
    let result = Reflect.deleteMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectDeleteMetadataWhenNotDefinedWithoutTargetKey = ReflectDeleteMetadataWhenNotDefinedWithoutTargetKey;
function ReflectDeleteMetadataWhenDefinedWithoutTargetKey() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    let result = Reflect.deleteMetadata("key", obj, undefined);
    assert.equal(result, true);
}
exports.ReflectDeleteMetadataWhenDefinedWithoutTargetKey = ReflectDeleteMetadataWhenDefinedWithoutTargetKey;
function ReflectDeleteMetadataWhenDefinedOnPrototypeWithoutTargetKey() {
    let prototype = {};
    Reflect.defineMetadata("key", "value", prototype, undefined);
    let obj = Object.create(prototype);
    let result = Reflect.deleteMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectDeleteMetadataWhenDefinedOnPrototypeWithoutTargetKey = ReflectDeleteMetadataWhenDefinedOnPrototypeWithoutTargetKey;
function ReflectHasOwnMetadataAfterDeleteMetadata() {
    let obj = {};
    Reflect.defineMetadata("key", "value", obj, undefined);
    Reflect.deleteMetadata("key", obj, undefined);
    let result = Reflect.hasOwnMetadata("key", obj, undefined);
    assert.equal(result, false);
}
exports.ReflectHasOwnMetadataAfterDeleteMetadata = ReflectHasOwnMetadataAfterDeleteMetadata;
//# sourceMappingURL=reflect-deletemetadata.js.map