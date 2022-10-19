"use strict";

let car = createCar ("toyota", "black");
    function createCar (model, color) {
        return {
            model,
            color
        };
    }
    console.log(car);