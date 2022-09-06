let i;
console.log(`Цикл for: `);

for (i = 0; i < 11; i += 2) {
    console.log(i);
}

i = 0;
while (true) {
    if (i > 10) break;
    console.log(i);
    i += 2;
}