"use strict";
// 4.1.7 Reflect.getOwnMetadata ( metadataKey, target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.getownmetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.getOwnMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.getOwnMetadata("key", undefined, undefined), TypeError);
    });
    it("WithoutTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, undefined);
    });
    it("WithoutTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.getOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, "value");
    });
    it("WithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let result = Reflect.getOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, undefined);
    });
    it("WithTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, undefined);
    });
    it("WithTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, "name");
        let result = Reflect.getOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, "value");
    });
    it("WithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, "name");
        let result = Reflect.getOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, undefined);
    });
});
//# sourceMappingURL=reflect-getownmetadata.js.map