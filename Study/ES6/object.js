"use strict";

let book = {
    title: "название",
    author: "автор",
    nPages: 0,
    price: 0,
    "size book": {height: 100, widht: 20}
};
    book.isSalled = false;
    book.isSalled = true;

    delete book.nPages;

    console.log(book.title);
    console.log(book.isSalled);
    console.log(book.nPages);
    console.log(book);
    console.log("nPages" in book);

    if (book.nPages === undefined) {
        console.log("nPages не существует");
    }
    book["size book"] = {height: 90, widht: 55};
    delete book["size book"]
    console.log(book["size book"]);