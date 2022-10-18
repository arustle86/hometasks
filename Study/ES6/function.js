"use strict"

let age = prompt("Сколько Вам лет?", 18);
 
    let setAcces = (age < 18) ?

        function() {
            console.log("Вы слишком молоды");
        } : function() {
            console.log("Всё ок");
        }

setAcces();