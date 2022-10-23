"use strict";

    let matrix = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ];

    matrix [1][1] = 0;

        for (let row of matrix) {
            let cols = "";
                for (let val of row) {
                    cols += val + " ";
                }
                console.log(cols);
        }