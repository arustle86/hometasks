"use strict";

    let car = {
        model: "Toyota",
        getModel(){
            return this.model;
        }
    };

    let get = car.getModel();
    console.log(car.getModel());