let cards = ['2', 'Туз', 'Король', '10', 'Дама', '7','Туз'];
let hand = [];
    for (let card of cards) {
        if (card !== 'Король' && card !== 'Туз') continue;
        hand.push (card);
        console.log('Карта ' + card + ' добавлена в руку');
    }
    console.log('Карты добавлены в руку: ', hand);