"use strict";
// 4.1.2 Reflect.metadata ( metadataKey, metadataValue )
// https://rbuckton.github.io/reflect-metadata/#reflect.metadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.metadata", () => {
    it("ReturnsDecoratorFunction", () => {
        let result = Reflect.metadata("key", "value");
        chai_1.assert.equal(typeof result, "function");
    });
    it("DecoratorThrowsWithInvalidTargetWithTargetKey", () => {
        let decorator = Reflect.metadata("key", "value");
        chai_1.assert.throws(() => decorator(undefined, "name"), TypeError);
    });
    it("DecoratorThrowsWithInvalidTargetKey", () => {
        let decorator = Reflect.metadata("key", "value");
        chai_1.assert.throws(() => decorator({}, {}), TypeError);
    });
    it("OnTargetWithoutTargetKey", () => {
        let decorator = Reflect.metadata("key", "value");
        let target = function () { };
        decorator(target);
        let result = Reflect.hasOwnMetadata("key", target, undefined);
        chai_1.assert.equal(result, true);
    });
    it("OnTargetWithTargetKey", () => {
        let decorator = Reflect.metadata("key", "value");
        let target = {};
        decorator(target, "name");
        let result = Reflect.hasOwnMetadata("key", target, "name");
        chai_1.assert.equal(result, true);
    });
});
//# sourceMappingURL=reflect-metadata.js.map