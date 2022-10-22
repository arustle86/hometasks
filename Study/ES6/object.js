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
        },
        getColor(){
            return this.color;
        }
    };


    car.go("Леонид");
    car.stop();
    console.log(car.getModel());
    console.log(car.getColor());
