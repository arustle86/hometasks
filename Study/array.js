let alphabet = [];

alphabet.push (`Г`);
alphabet.push (`Д`);
alphabet.push (`Е`, `Ж`, `З`);
alphabet.unshift (`В`);
alphabet.unshift (`А`, `Б`);
console.log (alphabet);
alphabet.length;
alphabet[alphabet.length - 2];


let greetings = [`hello`, `hi`, `good evning`, `good afternun`];
console.log (greetings[2]);
greetings[2] = `good evening`;
console.log (greetings[2]);