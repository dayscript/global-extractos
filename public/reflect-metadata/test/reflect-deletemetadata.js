"use strict";
// 4.1.10 Reflect.deleteMetadata ( metadataKey, target [, propertyKey] )
// https://rbuckton.github.io/reflect-metadata/#reflect.deletemetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.deleteMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.deleteMetadata("key", undefined, undefined), TypeError);
    });
    it("WhenNotDefinedWithoutTargetKey", () => {
        let obj = {};
        let result = Reflect.deleteMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
    it("WhenDefinedWithoutTargetKey", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        let result = Reflect.deleteMetadata("key", obj, undefined);
        chai_1.assert.equal(result, true);
    });
    it("WhenDefinedOnPrototypeWithoutTargetKey", () => {
        let prototype = {};
        Reflect.defineMetadata("key", "value", prototype, undefined);
        let obj = Object.create(prototype);
        let result = Reflect.deleteMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
    it("AfterDeleteMetadata", () => {
        let obj = {};
        Reflect.defineMetadata("key", "value", obj, undefined);
        Reflect.deleteMetadata("key", obj, undefined);
        let result = Reflect.hasOwnMetadata("key", obj, undefined);
        chai_1.assert.equal(result, false);
    });
});
//# sourceMappingURL=reflect-deletemetadata.js.map