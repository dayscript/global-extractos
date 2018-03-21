"use strict";
// 4.1.5 Reflect.getMetadata ( metadataKey, target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.getmetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.getMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.getMetadata("key", undefined, undefined), TypeError);
    });
    it("WithoutTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getMetadata("key", obj, undefined);
        chai_1.assert.equal(result, undefined);
    });
    it("WithoutTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.getMetadata("key", obj, undefined);
        chai_1.assert.equal(result, "value");
    });
    it("WithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let result = Reflect.getMetadata("key", obj, undefined);
        chai_1.assert.equal(result, "value");
    });
    it("WithTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.getMetadata("key", obj, "name");
        chai_1.assert.equal(result, undefined);
    });
    it("WithTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, "name");
        let result = Reflect.getMetadata("key", obj, "name");
        chai_1.assert.equal(result, "value");
    });
    it("WithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, "name");
        let result = Reflect.getMetadata("key", obj, "name");
        chai_1.assert.equal(result, "value");
    });
});
//# sourceMappingURL=reflect-getmetadata.js.map