"use strict";
// 4.1.8 Reflect.getMetadataKeys ( target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.getmetadatakeys
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.getMetadataKeys", () => {
    it("KeysInvalidTarget", () => {
        // 1. If Type(target) is not Object, throw a TypeError exception.
        chai_1.assert.throws(() => Reflect.getMetadataKeys(undefined, undefined), TypeError);
    });
    it("KeysWithoutTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, []);
    });
    it("KeysWithoutTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, ["key"]);
    });
    it("KeysWithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, ["key"]);
    });
    it("KeysOrderWithoutTargetKey", () => {
        let obj = {};
        Reflect.defineMetadata("key1", "value", obj, undefined);
        Reflect.defineMetadata("key0", "value", obj, undefined);
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, ["key1", "key0"]);
    });
    it("KeysOrderAfterRedefineWithoutTargetKey", () => {
        let obj = {};
        Reflect.defineMetadata("key1", "value", obj, undefined);
        Reflect.defineMetadata("key0", "value", obj, undefined);
        Reflect.defineMetadata("key1", "value", obj, undefined);
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, ["key1", "key0"]);
    });
    it("KeysOrderWithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        Reflect.defineMetadata("key2", "value", prototype, undefined);
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key1", "value", obj, undefined);
        Reflect.defineMetadata("key0", "value", obj, undefined);
        let result = Reflect.getMetadataKeys(obj, undefined);
        chai_1.assert.deepEqual(result, ["key1", "key0", "key2"]);
    });
    it("KeysWithTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getMetadataKeys(obj, "name");
        chai_1.assert.deepEqual(result, []);
    });
    it("KeysWithTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, "name");
        let result = Reflect.getMetadataKeys(obj, "name");
        chai_1.assert.deepEqual(result, ["key"]);
    });
    it("KeysWithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, "name");
        let result = Reflect.getMetadataKeys(obj, "name");
        chai_1.assert.deepEqual(result, ["key"]);
    });
    it("KeysOrderAfterRedefineWithTargetKey", () => {
        let obj = {};
        Reflect.defineMetadata("key1", "value", obj, "name");
        Reflect.defineMetadata("key0", "value", obj, "name");
        Reflect.defineMetadata("key1", "value", obj, "name");
        let result = Reflect.getMetadataKeys(obj, "name");
        chai_1.assert.deepEqual(result, ["key1", "key0"]);
    });
    it("KeysOrderWithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        Reflect.defineMetadata("key2", "value", prototype, "name");
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key1", "value", obj, "name");
        Reflect.defineMetadata("key0", "value", obj, "name");
        let result = Reflect.getMetadataKeys(obj, "name");
        chai_1.assert.deepEqual(result, ["key1", "key0", "key2"]);
    });
});
//# sourceMappingURL=reflect-getmetadatakeys.js.map