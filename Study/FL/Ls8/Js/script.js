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


function calcSum(numOne, numThu, more, less) {
    let numSum = numOne + numThu;
    if(numSum > 3) {
        more();
    } else {
        less();
    }
}
    function showMoreMassage() {
    console.log(`More than 3`);
}
function showLesMassage() {
    console.log(`Min than 3`);
}
calcSum(1, 1, showMoreMassage, showLesMassage);