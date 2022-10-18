"use stricr"

function showPrimes(n) {
    nextPrime: for (let i = 2; i < n;  i++) {
        for (let j = 2; j < i; j++) {
        if (i % j == 0) continue nextPrime;
        }
    console.log(i);
    }
}
showPrimes(10);


function showPrimes(n) {
    for (let i = 2; i < n; i++) {
        if (!isPrime(i)) continue;
            console.log(i);
    }
}

function isPrime(n) {
    for (let i = 2; i < n; i++) {
        if (n % i == 0) return false;
    }
        return true;
}

showPrimes(10);