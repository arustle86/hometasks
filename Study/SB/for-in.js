let rating = [`Katya`, `Nastya`, `Anya`, `Marya`];

console.log(`Rating of students: `);

for (let i in rating) {
    console.log(`${parseInt(i) + 1} место: ${rating[i]}`);
}