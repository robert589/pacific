// Type definitions for Math.js
// Project: https://github.com/josdejong/mathjs
// Definitions by: ComFreek <https://github.com/ComFreek>
// Definitions: https://github.com/borisyankov/DefinitelyTyped

declare module math {
    class BigNumber {
    }
    class Complex {
        // To distinguish it from BigNumber
        private xyz: any;
    }
    class Matrix {
        // To distinguish it from BigNumber and Complex
        private uvw: any;
    }

    function sqrt(radicand: number): any;
    function sqrt(radicand: BigNumber): any;
    function sqrt(radicand: boolean): any;
    function sqrt(radicand: Complex): any;
    // TODO: Array of what?
    function sqrt(radicand: any[]): any;
    function sqrt(radicand: Matrix): any;

    function add(x: number, y: number): any;
    function add(x: BigNumber, y: BigNumber): any;
    function add(x: Complex, y: Complex): any;
    function add(x: number, y: Complex): any;
    // ... and so on
    function eval(x : string) : string;
}

declare module 'math' {
    export = math;
}