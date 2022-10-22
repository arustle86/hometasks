    "use strict";

    let book = {
        title: "My-My",
        author: "Тургенев",
        price: 100,
        nPages: 282
    }
        for (let key in book) {
            console.log(key + ": " + book[key]);
        }