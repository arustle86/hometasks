"use strict";

 let a = [1, 2, 3, 4, 5, 6, 7, 8, 9];
 let b = ["a", "b", "c", "d", "e", "f"];
    
    // console.log(a.reverse());

    // function rev1 (a) {
    //     return a.reverse();
    // }
    //      console.log(rev1(a));

    // function rev2 (a) {
    //     res = [];
    //     a.forEach(element => {
    //         res.unshift(element)
    //     });
    //     return res;
    // }
    //     console.log(rev2(b));

    function rev3 (a) {
        res = [];
            for (let i = a.lenght - 1; i >= 0; i--) {
                res.push(a[i]);
            }
        return res;    
    }
        console.log(rev3(b));