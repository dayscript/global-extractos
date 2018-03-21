"use strict";
// Reflect.decorate ( decorators, target [, propertyKey [, descriptor] ] )
Object.defineProperty(exports, "__esModule", { value: true });
require("../Reflect");
const chai_1 = require("chai");
describe("Reflect.decorate", () => {
    it("ThrowsIfDecoratorsArgumentNotArrayForFunctionOverload", () => {
        let target = function () { };
        chai_1.assert.throws(() => Reflect.decorate(undefined, target, undefined, undefined), TypeError);
    });
    it("ThrowsIfTargetArgumentNotFunctionForFunctionOverload", () => {
        let decorators = [];
        let target = {};
        chai_1.assert.throws(() => Reflect.decorate(decorators, target, undefined, undefined), TypeError);
    });
    it("ThrowsIfDecoratorsArgumentNotArrayForPropertyOverload", () => {
        let target = {};
        let name = "name";
        chai_1.assert.throws(() => Reflect.decorate(undefined, target, name, undefined), TypeError);
    });
    it("ThrowsIfTargetArgumentNotObjectForPropertyOverload", () => {
        let decorators = [];
        let target = 1;
        let name = "name";
        chai_1.assert.throws(() => Reflect.decorate(decorators, target, name, undefined), TypeError);
    });
    it("ThrowsIfDecoratorsArgumentNotArrayForPropertyDescriptorOverload", () => {
        let target = {};
        let name = "name";
        let descriptor = {};
        chai_1.assert.throws(() => Reflect.decorate(undefined, target, name, descriptor), TypeError);
    });
    it("ThrowsIfTargetArgumentNotObjectForPropertyDescriptorOverload", () => {
        let decorators = [];
        let target = 1;
        let name = "name";
        let descriptor = {};
        chai_1.assert.throws(() => Reflect.decorate(decorators, target, name, descriptor), TypeError);
    });
    it("ExecutesDecoratorsInReverseOrderForFunctionOverload", () => {
        let order = [];
        let decorators = [
            (target) => { order.push(0); },
            (target) => { order.push(1); }
        ];
        let target = function () { };
        Reflect.decorate(decorators, target);
        chai_1.assert.deepEqual(order, [1, 0]);
    });
    it("ExecutesDecoratorsInReverseOrderForPropertyOverload", () => {
        let order = [];
        let decorators = [
            (target, name) => { order.push(0); },
            (target, name) => { order.push(1); }
        ];
        let target = {};
        let name = "name";
        Reflect.decorate(decorators, target, name, undefined);
        chai_1.assert.deepEqual(order, [1, 0]);
    });
    it("ExecutesDecoratorsInReverseOrderForPropertyDescriptorOverload", () => {
        let order = [];
        let decorators = [
            (target, name) => { order.push(0); },
            (target, name) => { order.push(1); }
        ];
        let target = {};
        let name = "name";
        let descriptor = {};
        Reflect.decorate(decorators, target, name, descriptor);
        chai_1.assert.deepEqual(order, [1, 0]);
    });
    it("DecoratorPipelineForFunctionOverload", () => {
        let A = function A() { };
        let B = function B() { };
        let decorators = [
            (target) => { return undefined; },
            (target) => { return A; },
            (target) => { return B; }
        ];
        let target = function () { };
        let result = Reflect.decorate(decorators, target);
        chai_1.assert.strictEqual(result, A);
    });
    it("DecoratorPipelineForPropertyOverload", () => {
        let A = {};
        let B = {};
        let decorators = [
            (target, name) => { return undefined; },
            (target, name) => { return A; },
            (target, name) => { return B; }
        ];
        let target = {};
        let result = Reflect.decorate(decorators, target, "name", undefined);
        chai_1.assert.strictEqual(result, A);
    });
    it("DecoratorPipelineForPropertyDescriptorOverload", () => {
        let A = {};
        let B = {};
        let C = {};
        let decorators = [
            (target, name) => { return undefined; },
            (target, name) => { return A; },
            (target, name) => { return B; }
        ];
        let target = {};
        let result = Reflect.decorate(decorators, target, "name", C);
        chai_1.assert.strictEqual(result, A);
    });
    it("DecoratorCorrectTargetInPipelineForFunctionOverload", () => {
        let sent = [];
        let A = function A() { };
        let B = function B() { };
        let decorators = [
            (target) => { sent.push(target); return undefined; },
            (target) => { sent.push(target); return undefined; },
            (target) => { sent.push(target); return A; },
            (target) => { sent.push(target); return B; }
        ];
        let target = function () { };
        Reflect.decorate(decorators, target);
        chai_1.assert.deepEqual(sent, [target, B, A, A]);
    });
    it("DecoratorCorrectTargetInPipelineForPropertyOverload", () => {
        let sent = [];
        let decorators = [
            (target, name) => { sent.push(target); },
            (target, name) => { sent.push(target); },
            (target, name) => { sent.push(target); },
            (target, name) => { sent.push(target); }
        ];
        let target = {};
        Reflect.decorate(decorators, target, "name");
        chai_1.assert.deepEqual(sent, [target, target, target, target]);
    });
    it("DecoratorCorrectNameInPipelineForPropertyOverload", () => {
        let sent = [];
        let decorators = [
            (target, name) => { sent.push(name); },
            (target, name) => { sent.push(name); },
            (target, name) => { sent.push(name); },
            (target, name) => { sent.push(name); }
        ];
        let target = {};
        Reflect.decorate(decorators, target, "name");
        chai_1.assert.deepEqual(sent, ["name", "name", "name", "name"]);
    });
    it("DecoratorCorrectTargetInPipelineForPropertyDescriptorOverload", () => {
        let sent = [];
        let A = {};
        let B = {};
        let C = {};
        let decorators = [
            (target, name) => { sent.push(target); return undefined; },
            (target, name) => { sent.push(target); return undefined; },
            (target, name) => { sent.push(target); return A; },
            (target, name) => { sent.push(target); return B; }
        ];
        let target = {};
        Reflect.decorate(decorators, target, "name", C);
        chai_1.assert.deepEqual(sent, [target, target, target, target]);
    });
    it("DecoratorCorrectNameInPipelineForPropertyDescriptorOverload", () => {
        let sent = [];
        let A = {};
        let B = {};
        let C = {};
        let decorators = [
            (target, name) => { sent.push(name); return undefined; },
            (target, name) => { sent.push(name); return undefined; },
            (target, name) => { sent.push(name); return A; },
            (target, name) => { sent.push(name); return B; }
        ];
        let target = {};
        Reflect.decorate(decorators, target, "name", C);
        chai_1.assert.deepEqual(sent, ["name", "name", "name", "name"]);
    });
    it("DecoratorCorrectDescriptorInPipelineForPropertyDescriptorOverload", () => {
        let sent = [];
        let A = {};
        let B = {};
        let C = {};
        let decorators = [
            (target, name, descriptor) => { sent.push(descriptor); return undefined; },
            (target, name, descriptor) => { sent.push(descriptor); return undefined; },
            (target, name, descriptor) => { sent.push(descriptor); return A; },
            (target, name, descriptor) => { sent.push(descriptor); return B; }
        ];
        let target = {};
        Reflect.decorate(decorators, target, "name", C);
        chai_1.assert.deepEqual(sent, [C, B, A, A]);
    });
});
//# sourceMappingURL=reflect-decorate.js.map