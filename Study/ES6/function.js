"use strict"

let showMassage = function() {
    console.log("Привет, Мир!");
};

let show = showMassage;
showMassage();

console.log(showMassage);
console.log(typeof showMassage);