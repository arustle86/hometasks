    "use strict";

    let car = createCar("toyota", "black");
        function createCar (model, color) {
            return {
                model: model,
                color: color
            }
        };

                console.log(car.model, car.color);