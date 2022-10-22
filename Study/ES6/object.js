    "use strict";

    let book = {
        title: "Название",
        author: "Автор",
        nPages: 0,
        price: 22
    };

        let keyName = prompt("Что вы хотите узнать о книге?", "");
            console.log(book[keyName]);