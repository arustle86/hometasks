"use strict";

    function Book(title, author, price) {
        this.title = title;
        this.author = author;
        this.price = price;
    }

    let book1 = new Book("Муму", "Тургенев", 299);
    console.log( book1 );

    let book2 = new Book("Онегин", "Пушкин", 499);
    console.log( book2 );