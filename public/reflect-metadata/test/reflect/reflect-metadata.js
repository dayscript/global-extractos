"use strict";
// Reflect.metadata ( metadataKey, metadataValue )
// - https://github.com/jonathandturner/decorators/blob/master/specs/metadata.md#reflectmetadata--metadatakey-metadatavalue-
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectMetadataReturnsDecoratorFunction() {
    let result = Reflect.metadata("key", "value");
    assert.equal(typeof result, "function");
}
exports.ReflectMetadataReturnsDecoratorFunction = ReflectMetadataReturnsDecoratorFunction;
function ReflectMetadataDecoratorThrowsWithInvalidTargetWithTargetKey() {
    let decorator = Reflect.metadata("key", "value");
    assert.throws(() => decorator(undefined, "name"), TypeError);
}
exports.ReflectMetadataDecoratorThrowsWithInvalidTargetWithTargetKey = ReflectMetadataDecoratorThrowsWithInvalidTargetWithTargetKey;
function ReflectMetadataDecoratorThrowsWithInvalidTargetWithoutTargetKey() {
    let decorator = Reflect.metadata("key", "value");
    assert.throws(() => decorator({}, undefined), TypeError);
}
exports.ReflectMetadataDecoratorThrowsWithInvalidTargetWithoutTargetKey = ReflectMetadataDecoratorThrowsWithInvalidTargetWithoutTargetKey;
function ReflectMetadataDecoratorSetsMetadataOnTargetWithoutTargetKey() {
    let decorator = Reflect.metadata("key", "value");
    let target = function () { };
    decorator(target);
    let result = Reflect.hasOwnMetadata("key", target, undefined);
    assert.equal(result, true);
}
exports.ReflectMetadataDecoratorSetsMetadataOnTargetWithoutTargetKey = ReflectMetadataDecoratorSetsMetadataOnTargetWithoutTargetKey;
function ReflectMetadataDecoratorSetsMetadataOnTargetWithTargetKey() {
    let decorator = Reflect.metadata("key", "value");
    let target = {};
    decorator(target, "name");
    let result = Reflect.hasOwnMetadata("key", target, "name");
    assert.equal(result, true);
}
exports.ReflectMetadataDecoratorSetsMetadataOnTargetWithTargetKey = ReflectMetadataDecoratorSetsMetadataOnTargetWithTargetKey;
//# sourceMappingURL=reflect-metadata.js.map