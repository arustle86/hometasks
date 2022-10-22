"use strict";

    let book = {
        title: "My-My",
        author: "Тургенев",
        nShits: 543,
        price: 299,
        size: {height: 100, widht: 50}
    };

    let jurnal = cloneObject({}, book);
    book.size.height = 0;
    console.log(jurnal);

    function cloneObject(newObject, oldObjedt) {
        for (let key in oldObjedt) {
            if((typeof oldObjedt[key]) == "object") {
                newObject[key] = cloneObject({}, oldObjedt[key]);
            } else {
                newObject[key] = oldObjedt[key];
            }
        }
      return newObject;
    }