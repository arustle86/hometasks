let cards = ['2', 'Туз', 'Король', '10', 'Дама', '7','Туз'];
console.log('Ищем даму в колоде...');

let found = false;

for (let card of cards) {
    console.log('Из колоды вытянута карта ${card}');
    if (card === 'Дама') {
        found = true;
        break;
    }
}
console.log(found ? 'Мы нашли даму' : 'В этой колоде дамы нет');
