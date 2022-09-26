"use strict";

// let user = "Alex";
//     age = 25;
//     email = "1@may.ru";

// let cl = "class = \"my class\"";
// let cl = 'class = "my class"';
// console.log(cl);

// let isWin = true, isCheckedField = false;
// let isGreater = 4 < 1;
// console.log(isGreater);

// let age = prompt(`Сколько Вам лет?`, 18);
// console.log(age);

// let isCar = confirm("У тебя есть машина?");
// console.log(isCar);

// let x = 0, sgn = 0;
//     if (x < 0) {
//         sgn = -1;
//         console.log(`x отрицательное число, `, sgn);
//     } else {
//         if (x > 0) {
//             sgn = 1;
//             console.log(`x положительное число, `, sgn);
//         }
//         else {
//             console.log(`x равен 0, `, sgn);
//         }
//     }

// let age = 25;
// let currentAge = age > 18;
// console.log(currentAge);

// let x = 41;
//     if (x > 2 && x < 7) {
//         console.log(`x попадает в нужный диапазон`);
//     } else {
//         console.log(`x НЕ попдходит`);
//     }

// x в диапозоне [2 ; 7]; y не пренадлежит [0 ; 5]
// let x = 4, y = -2;
// if (x >= 2 && x <= 7 && (y < 0 || y > 5)) {
//     console.log(`x находится в диапазоне [2 ; 7], а y не находится в диапазоне [0 ; 5]`);
// } else {
//     console.log( `Данные не подходят по условию выражения`);
// }

// let item = 3;
// switch (item) {
//     case 1: console.log(`no`);
//     case 2: console.log(`no`);
//     case 3: console.log(`yes`); break;
//     case 4: console.log(`no`);
//     case 5: console.log(`no`);
//     default: console.log(`another`);
// }

// let s = 0, i = 1;
//     while (i <= 1000) {
//         s += 1 / i;
//         ++i;
//     }
//         console.log(s);

// let s = 0, i = 1;
//     while (i <= 1000 && s < 5) {
//         s += 1/i;
//         ++i;
//     } console.log(s);

// let s = 0, i = 1;
//     while ((s += i++) < 100);
//     console.log(s);

// let s = 0;
//     for (let i = 1; i <= 1000; ++i) {
//         s += 1 / i;
//     } console.log(s);

// let f, k = 0.5, b = 2;
// for (let x = 0; x <= 1; x += 0.1) {
//     f = k * x + b;
//     console.log(f);
// }

// const PSW = "password";
// let psw = null;
// do {
//   psw = prompt("Введите пароль", "");
// } while (psw != PSW);
// console.log("Вы вошли в систему!");

// let s = 0,
//   m = 10,
//   n = 5;
// for (let i = 1; i <= n; ++i) for (let j = 1; j <= m; ++j) s += i * j;
// console.log("S = " + s);

// let s = 0,
//   m = 10,
//   n = 5;
// all: for (let i = 1; i <= n; ++i)
//   for (let j = 1; j <= m; ++j) {
//     if (j == 5) break all;
//     s += i * j;
//   }
// console.log("S = " + s);

// for (let i = -5; i <= 5; ++i) {
//   if (i == 0) continue;
//   console.log("i = " + i);
// }
