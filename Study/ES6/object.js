"use strict";

    let car = {
        model: "toyota",
        color: "black",
        go(driverName) {
            console.log("Водитель " + driverName + ": машина едет");
        },
        stop() {
            console.log("Машина остановилась");
        },
        getModel(){
            return this.model;
        }
    };


    car.go("Maxim");
    car.stop();
    console.log(car.getModel());
