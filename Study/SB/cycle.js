 let fibo = [1, 1];
 
 for (let i = 1; i < 49; i++)
    fibo.push(fibo[1] + fibo[i - 1]); {
    console.log (fibo)
    }



 for (;;) {
    console.log (`Я буду сниться тебе вечно`)
    }
 


 for ( ; Math.random() >= 0.1; ) {
    console.log (`И еще разок`)
    }



 let i = 10;
 for ( ; i > 0; ) {
    console.log (`i = ` + i--)
    }



 let fruits = [`Яблоко`, `Банан`, `Апельсин`, `Ананас`, `Дыня`]; {
    console.log (`Сегодня я съел: `);
    }

 for (let fruit of fruits) {
    console.log (fruit);
    }



 let rating = [`Катя`, `Вася`, `Маша`, `Петя`, `Лена`]; {
    console.log (`Рейтинг студентов: `)
    }

 for (let i in rating) {
    console.log (`${(i) + 1} место: ${rating[i]}`)
    }



 let teaVolume = 200;
    console.log (`Вы налили себе ` + teaVolume + `мл чая`);

    while (teaVolume > 0) {
        teaVolume -= 10;
        console.log (`В чашке осталось ` + teaVolume + `мл чая`)
    }
    console.log (`Вы выпили весь чай =)`)



 do {
    console.log (`Нажимаем на курок`);
        } while (Math.random() > 0.2)
     console.log (`Похоже, Вам не повезло...`)

        

 let cards = [`2`, `Король`, `3`, `6`, `Дама`, `Валет`, `10`, `6`, `Туз`];
 let hand = [];
 
 for (let card of cards) {
    if (card != `Король` && card != `Туз`)
        continue;
            hand.push(card);
                console.log (`Карта ` + card + ` добавлена в руку`);
                    }
                    console.log (`Карты в руке`, hand);

                    

 let cards = [`2`, `Король`, `3`, `6`, `Дама`, `Валет`, `10`, `6`, `Туз`];
        console.log (`Ищем Даму в голоде....`);
                    let found = false;
            for (let card of cards) {
                console.log (`Из колоды вытянута карта ${card}`);
                    if (card === `Дама`) {
                        found = true;
                            break;
                        }
                    }
        console.log (found ? `Мы нашли даму` : `В колоде такой карты нет`)            



 let i;
 
 console.log (`Цикл for`);

    for (i = 0; i < 11; i += 2) {
        console.log (i);
    }



 console.log (`Цикл while`);
    
    i = 0;
    while (true) {
        if (i > 10) break;
            console.log (i);
                i += 2;
    }     



 for (let i = 0; i < 10; i ++) {
    console.log (i);
    } 
 
 

 let a = [];
    for (let i = 0; i < 10; i ++) {
        a.push (i * i);
    }   



 let b = [];
    for (let pow2 of a) {
        b.push ( pow2 / 2);
    }



 let lines = [];
    let next;
        while (next = file.nextLine()) {
            lines.push(next);
    }



  for (let line of lines) {
    console.log (`Длина строки: `, line.lenght)
    }      



  for (let number in lines) {
    console.log (`Длина строки №${number}: ${lines[number].lenght}`)
    }  



  let aReversed = [];
    for (let i = a.length - 1; i > 0; i--) {
        aReversed.push(a[i]);
    }



 let currentAttemp = 0;
    while (currentAttemp++ < 1000){
        if (crayfishWhistles()) break;
    }



 for (let i in a) {
    console.log (a[i] = aReversed[i]);
 }
 for (let i = 0; i < a.length; ++i) {
    console.log (a[i] = aReversed[i]);s
 }



 for (let x = 0; x < 100; x += (Math.random() * 5)) {
    console.log (x);
 }