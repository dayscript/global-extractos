"use strict";
// Reflect.decorate ( decorators, target [, propertyKey [, descriptor] ] )
Object.defineProperty(exports, "__esModule", { value: true });
require("../../Reflect");
const assert = require("assert");
function ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForFunctionOverload() {
    let target = function () { };
    assert.throws(() => Reflect.decorate(undefined, target, undefined, undefined), TypeError);
}
exports.ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForFunctionOverload = ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForFunctionOverload;
function ReflectDecorateThrowsIfTargetArgumentNotFunctionForFunctionOverload() {
    let decorators = [];
    let target = {};
    assert.throws(() => Reflect.decorate(decorators, target, undefined, undefined), TypeError);
}
exports.ReflectDecorateThrowsIfTargetArgumentNotFunctionForFunctionOverload = ReflectDecorateThrowsIfTargetArgumentNotFunctionForFunctionOverload;
function ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyOverload() {
    let target = {};
    let name = "name";
    assert.throws(() => Reflect.decorate(undefined, target, name, undefined), TypeError);
}
exports.ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyOverload = ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyOverload;
function ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyOverload() {
    let decorators = [];
    let target = 1;
    let name = "name";
    assert.throws(() => Reflect.decorate(decorators, target, name, undefined), TypeError);
}
exports.ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyOverload = ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyOverload;
function ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyDescriptorOverload() {
    let target = {};
    let name = "name";
    let descriptor = {};
    assert.throws(() => Reflect.decorate(undefined, target, name, descriptor), TypeError);
}
exports.ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyDescriptorOverload = ReflectDecorateThrowsIfDecoratorsArgumentNotArrayForPropertyDescriptorOverload;
function ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyDescriptorOverload() {
    let decorators = [];
    let target = 1;
    let name = "name";
    let descriptor = {};
    assert.throws(() => Reflect.decorate(decorators, target, name, descriptor), TypeError);
}
exports.ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyDescriptorOverload = ReflectDecorateThrowsIfTargetArgumentNotObjectForPropertyDescriptorOverload;
function ReflectDecorateExecutesDecoratorsInReverseOrderForFunctionOverload() {
    let order = [];
    let decorators = [
        (target) => { order.push(0); },
        (target) => { order.push(1); }
    ];
    let target = function () { };
    Reflect.decorate(decorators, target);
    assert.deepEqual(order, [1, 0]);
}
exports.ReflectDecorateExecutesDecoratorsInReverseOrderForFunctionOverload = ReflectDecorateExecutesDecoratorsInReverseOrderForFunctionOverload;
function ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyOverload() {
    let order = [];
    let decorators = [
        (target, name) => { order.push(0); },
        (target, name) => { order.push(1); }
    ];
    let target = {};
    let name = "name";
    Reflect.decorate(decorators, target, name, undefined);
    assert.deepEqual(order, [1, 0]);
}
exports.ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyOverload = ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyOverload;
function ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyDescriptorOverload() {
    let order = [];
    let decorators = [
        (target, name) => { order.push(0); },
        (target, name) => { order.push(1); }
    ];
    let target = {};
    let name = "name";
    let descriptor = {};
    Reflect.decorate(decorators, target, name, descriptor);
    assert.deepEqual(order, [1, 0]);
}
exports.ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyDescriptorOverload = ReflectDecorateExecutesDecoratorsInReverseOrderForPropertyDescriptorOverload;
function ReflectDecoratorPipelineForFunctionOverload() {
    let A = function A() { };
    let B = function B() { };
    let decorators = [
        (target) => { return undefined; },
        (target) => { return A; },
        (target) => { return B; }
    ];
    let target = function () { };
    let result = Reflect.decorate(decorators, target);
    assert.strictEqual(result, A);
}
exports.ReflectDecoratorPipelineForFunctionOverload = ReflectDecoratorPipelineForFunctionOverload;
function ReflectDecoratorPipelineForPropertyOverload() {
    let A = {};
    let B = {};
    let decorators = [
        (target, name) => { return undefined; },
        (target, name) => { return A; },
        (target, name) => { return B; }
    ];
    let target = {};
    let result = Reflect.decorate(decorators, target, "name", undefined);
    assert.strictEqual(result, A);
}
exports.ReflectDecoratorPipelineForPropertyOverload = ReflectDecoratorPipelineForPropertyOverload;
function ReflectDecoratorPipelineForPropertyDescriptorOverload() {
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
    assert.strictEqual(result, A);
}
exports.ReflectDecoratorPipelineForPropertyDescriptorOverload = ReflectDecoratorPipelineForPropertyDescriptorOverload;
function ReflectDecoratorCorrectTargetInPipelineForFunctionOverload() {
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
    assert.deepEqual(sent, [target, B, A, A]);
}
exports.ReflectDecoratorCorrectTargetInPipelineForFunctionOverload = ReflectDecoratorCorrectTargetInPipelineForFunctionOverload;
function ReflectDecoratorCorrectTargetInPipelineForPropertyOverload() {
    let sent = [];
    let decorators = [
        (target, name) => { sent.push(target); },
        (target, name) => { sent.push(target); },
        (target, name) => { sent.push(target); },
        (target, name) => { sent.push(target); }
    ];
    let target = {};
    Reflect.decorate(decorators, target, "name");
    assert.deepEqual(sent, [target, target, target, target]);
}
exports.ReflectDecoratorCorrectTargetInPipelineForPropertyOverload = ReflectDecoratorCorrectTargetInPipelineForPropertyOverload;
function ReflectDecoratorCorrectNameInPipelineForPropertyOverload() {
    let sent = [];
    let decorators = [
        (target, name) => { sent.push(name); },
        (target, name) => { sent.push(name); },
        (target, name) => { sent.push(name); },
        (target, name) => { sent.push(name); }
    ];
    let target = {};
    Reflect.decorate(decorators, target, "name");
    assert.deepEqual(sent, ["name", "name", "name", "name"]);
}
exports.ReflectDecoratorCorrectNameInPipelineForPropertyOverload = ReflectDecoratorCorrectNameInPipelineForPropertyOverload;
function ReflectDecoratorCorrectTargetInPipelineForPropertyDescriptorOverload() {
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
    assert.deepEqual(sent, [target, target, target, target]);
}
exports.ReflectDecoratorCorrectTargetInPipelineForPropertyDescriptorOverload = ReflectDecoratorCorrectTargetInPipelineForPropertyDescriptorOverload;
function ReflectDecoratorCorrectNameInPipelineForPropertyDescriptorOverload() {
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
    assert.deepEqual(sent, ["name", "name", "name", "name"]);
}
exports.ReflectDecoratorCorrectNameInPipelineForPropertyDescriptorOverload = ReflectDecoratorCorrectNameInPipelineForPropertyDescriptorOverload;
function ReflectDecoratorCorrectDescriptorInPipelineForPropertyDescriptorOverload() {
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
    assert.deepEqual(sent, [C, B, A, A]);
}
exports.ReflectDecoratorCorrectDescriptorInPipelineForPropertyDescriptorOverload = ReflectDecoratorCorrectDescriptorInPipelineForPropertyDescriptorOverload;
//# sourceMappingURL=reflect-decorate.js.map