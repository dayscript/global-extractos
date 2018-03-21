"use strict";
// 4.1.2 Reflect.defineMetadata ( metadataKey, metadataValue, target, propertyKey )
// https://rbuckton.github.io/reflect-metadata/#reflect.definemetadata
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.defineMetadata", () => {
    it("InvalidTarget", () => {
        chai_1.assert.throws(() => Reflect.defineMetadata("key", "value", undefined, undefined), TypeError);
    });
    it("ValidTargetWithoutTargetKey", () => {
        chai_1.assert.doesNotThrow(() => Reflect.defineMetadata("key", "value", {}, undefined));
    });
    it("ValidTargetWithTargetKey", () => {
        chai_1.assert.doesNotThrow(() => Reflect.defineMetadata("key", "value", {}, "name"));
    });
});
//# sourceMappingURL=reflect-definemetadata.js.map