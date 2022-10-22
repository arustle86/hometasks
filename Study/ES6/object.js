"use strict";

    let book1 = {
        title: "My-My",
        author: "Автор",
        price: 122,
        sheets: 547
    };
        let book2 = book1;
        book2.title = "Алхимик";

        console.log(book1.title);