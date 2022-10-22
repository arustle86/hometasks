"use strict";

    let car = {
        model: "toyota",
        color: "black",
        go: function() {
            console.log("Машина едет");
        },
        stop: function() {
            console.log("Машина остановилась");
        }
    };

    car.go();
    car.stop();
