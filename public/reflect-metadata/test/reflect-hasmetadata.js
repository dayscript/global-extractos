"use strict";
// 4.1.4 Reflect.hasMetadata ( metadataKey, target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.hasmetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.hasMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.hasMetadata("key", undefined, undefined), TypeError);
    });
    it("WithoutTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.hasMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
    it("WithoutTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.hasMetadata("key", obj, undefined);
        chai_1.assert.equal(result, true);
    });
    it("WithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let result = Reflect.hasMetadata("key", obj, undefined);
        chai_1.assert.equal(result, true);
    });
    it("WithTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.hasMetadata("key", obj, "name");
        chai_1.assert.equal(result, false);
    });
    it("WithTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, "name");
        let result = Reflect.hasMetadata("key", obj, "name");
        chai_1.assert.equal(result, true);
    });
    it("WithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, "name");
        let result = Reflect.hasMetadata("key", obj, "name");
        chai_1.assert.equal(result, true);
    });
});
//# sourceMappingURL=reflect-hasmetadata.js.map