function findLongestWord(text: string): string {
    let whitespace: string = " ";
    let words: string[] = text.split(whitespace);
    let longestWord: null = null;

    for (let word of words) {
        if (word.length > (longestWord?.length ?? 0)) {
            longestWord = word;
        }
    }
    return longestWord;
}

let longestWord = findLongestWord("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua");
console.log(longestWord);


