let book = {
    title: "название",
    author: "автор",
    nPages: 0,
    price: 0
};
    book.isSalled = false;
    book.isSalled = true;

    delete book.nPages;

    console.log(book.title);
    console.log(book.isSalled);
    console.log(book.nPages);
    console.log(book);
    console.log("nPages" in book);