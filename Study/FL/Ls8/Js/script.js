// function showMassage() {
//     console.log(`Сообщение `);
// }
// showMassage();



// function getSum() {
//     let numOne, numThow;
// }
// function getNumOne() {
//     numOne = 1;
// }
// function getNumThow() {
//     numThow = 2;
// }
// getNumOne();
// getNumThow();
// let numSum = numOne + numThow;
// console.log(numSum);
// getSum();



// let massage = `Msg 1`;
// function showMassage() {
//     let massage = `Msg 2`;
//     console.log(massage);
// }
// console.log(massage);
// showMassage();



// let globalVar = `Я глобальная переменная`;
// function getSum() {
//     let numOne, numThow;
//     function getNumOne() {
//         numOne = 1;
//         console.log(globalVar);
//     }
//     function getNumThow() {
//         numThow = 2;
//     }
//     getNumOne();
//     getNumThow();

//     let numSum = numOne + numThow;
//     console.log(globalVar)
// }
// console.log(globalVar)
// getSum();



// function calcSum(numOne, numThu) {
//     console.log(`Firs Number: ${numOne}`);
//     console.log(`Second Number: ${numThu}`);
//     let numSum = numOne + numThu;
//     console.log(`Summ: ${numSum}`);
// }
// calcSum(1, 2);



// function calcSum(numOne, numThu, more, less) {
//     let numSum = numOne + numThu;
//     if(numSum > 3) {
//         more();
//     } else {
//         less();
//     }
// }
//     function showMoreMassage() {
//     console.log(`More than 3`);
// }
// function showLesMassage() {
//     console.log(`Min than 3`);
// }
// calcSum(1, 1, showMoreMassage, showLesMassage);



// function calcSum(numOne, numThu) {
//     let numSum = numOne + numThu;
//     return numSum;
// }
// let funcRezult = calcSum (1, 2);
// console.log(`Price: ${funcRezult}`);



// function getSum(numOne, numThu) {
//  let numSum = calcSum(numOne, numThu);
//  console.log(numSum);
// }
// function calcSum(numOne, numThu) {
//     return numOne + numThu;
// }
// getSum (3, 7);



// function calcSum(numOne, numThu) {
//     let result = 1;
// for (let i = 0; i < numThu; i++) {
//     result *= numOne;
//         }
//     return result;
// }
// console.log(calcSum(2, 3));



// function calcSum(numOne, numThu) {
//     if(numThu === 1) {
//         return numOne;
//       } else {
//         return numOne * calcSum(numOne, numThu  - 1);
//     }
// }
// console.log(calcSum(2, 3));



// let showMassage = function() {
//     console.log(`Hi`);
// }
// showMassage();



// function getSum() {
//     let summ = 1 + 2;
//     console.log(summ);
// }
// let sumVar = getSum;
// sumVar();
// getSum();



// `use strict`
// if(2 > 1) {
//     function getSum() {
//         let sum = 2 + 1;
//         console.log(sum);
//     }
// }
// getSum();



// let getMassage = (text , name) => text + `, `+ name;
// console.log(getMassage(`Hi`, `Vasya`));



// let getMassage = (text, name) => {
//     let massage = text + `, ` + name + ` !`;
//     return massage;
// }; 
// console.log(getMassage(`Hi`, `Vasya`));



// function showMassage(text, name) {
//     console.log(`${text}, ${name}!`);
// }
// setTimeout(showMassage, 3000, `Hi `, `Vasya!`)



// function showMassage(text, name) {
//     console.log(`${text}, ${name}!`);
//     setTimeout(showMassage, 500, text, name)
// }
// setTimeout(showMassage, 500, `Hi `, `Vasya!`)



// function showNumber(num) {
//     console.log(num);
//     if (num < 5) {
//     setTimeout(showNumber, 3000, ++num);
//     }
// }
// setTimeout(showNumber, 3000, 1);



// function showNumber(num) {
//     console.log(num);
//     let timeId = setTimeout(showNumber, 1000, ++num);
//     if (num === 6) {
//         clearTimeout(timeId);
//     }
// }

// setTimeout(showNumber, 1000, 1);


// let result = 0;
// function showNumber(num) {
//     result += num;
//     console.log(result);
//     if (result ===5){
//         clearInterval(timeId);
//     }
// }
// let timeId = setInterval(showNumber, 1000, 1);