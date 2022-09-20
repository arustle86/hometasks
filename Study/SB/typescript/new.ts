console.log(typeof 5 + 3);

let myNumber: number = 2021;
let myString: string = "typescript";
let myBoolean: boolean = true;
let myObject: object = {};
let myFunction: Function = () => {};
let myUndefined: void = undefined; 

console.log(typeof myNumber);
console.log(typeof myString);
console.log(typeof myBoolean);
console.log(typeof myObject);
console.log(typeof myFunction);
console.log(typeof myUndefined);

let num1: number = 100;
let str1: string = num1.toString();
num1.toFixed();
str1.toUpperCase();
str1.toLowerCase();

function formatNumber(number: number): string {
    return number.toFixed(2);
}

console.log(formatNumber(2));
