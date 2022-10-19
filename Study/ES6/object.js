"use strict";

let book = {
    title: "название",
    author: "автор",
    nPages: 0,
    price: 0,
    "size book": {height: 100, widht: 20}
};
    let keyName = prompt("Что Вы хотите узнать о книге?", "");
    console.log(book[keyName]);