"use strict";
// 4.1.5 Reflect.hasOwnMetadata ( metadataKey, target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.hasownmetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.hasOwnMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.hasOwnMetadata("key", undefined, undefined), TypeError);
    });
    it("WithoutTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.hasOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
    it("WithoutTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.hasOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, true);
    });
    it("WithoutTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let result = Reflect.hasOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
    it("WithTargetKeyWhenNotDefined", () => {
        let obj = {};
        let result = Reflect.hasOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, false);
    });
    it("WithTargetKeyWhenDefined", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, "name");
        let result = Reflect.hasOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, true);
    });
    it("WithTargetKeyWhenDefinedOnPrototype", () => {
        let prototype = {};
        let obj = Object.create(prototype);
        Reflect.defineMetadata("key", "value", prototype, "name");
        let result = Reflect.hasOwnMetadata("key", obj, "name");
        chai_1.assert.equal(result, false);
    });
});
//# sourceMappingURL=reflect-hasownmetadata.js.map