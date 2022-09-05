let teaVolume = 200;

console.log('Вы налили себе: ' + teaVolume + ' мл чая');

while (teaVolume > 0) {
    teaVolume -= 10;
    console.log('В чашке осталось: ' + teaVolume + ' мл чая');
}
console.log('Вы выпили весь чай ... ');