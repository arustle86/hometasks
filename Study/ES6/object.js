"use strict";

    function Book(title, author) {

        if (new.target == undefined)
            return new Book (title, author);

        this.title = title;
        this.author = author;
        this.price = 119;
        return this;
    }

    let book = Book("Онегин", "Пушкин");
    console.log(book);