let fibo = [1, 1];
for (let i = 1; i < 49; i++)
    fibo.push(fibo[1] + fibo[i - 1]); {
    console.log(fibo)
    }



 for (;;) {
    console.log(`Я буду сниться тебе вечно`)
    }
 


 for ( ; Math.random() >= 0.1; ) {
    console.log(`И еще разок`)
    }



 let i = 10;
 for ( ; i > 0; ){
    console.log(`i = ` + i--)
    }



 let fruits = [`Яблоко`, `Банан`, `Апельсин`, `Ананас`, `Дыня`]; {
    console.log(`Сегодня я съел: `);
    }

 for (let fruit of fruits) {
    console.log(fruit);
    }



 let rating = [`Катя`, `Вася`, `Маша`, `Петя`, `Лена`]; {
    console.log(`Рейтинг студентов: `)
    }

 for (let i in rating) {
    console.log(`${(i) + 1} место: ${rating[i]}`)
    }



 let teaVolume = 200;
    console.log(`Вы налили себе ` + teaVolume + `мл чая`);

    while (teaVolume > 0){
        teaVolume -= 10;
        console.log(`В чашке осталось ` + teaVolume + `мл чая`)
    }
    console.log(`Вы выпили весь чай =)`)



 do {
    console.log(`Нажимаем на курок`);
    } while (Math.random() > 0.2)
        console.log(`Похоже, Вам не повезло...`)

        

 let cards = [`2`, `Король`, `Туз`, `3`, `6`, `Дама`, `Валет`, `10`, `6`, `Король`];
 let hand = [];
 

