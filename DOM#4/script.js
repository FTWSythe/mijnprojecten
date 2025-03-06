// Haal de HTML-elementen op
var wordInput = document.getElementById("wordInput");
var checkButton = document.getElementById("checkButton");
var reversedWordDisplay = document.getElementById("reversedWord");
var palindromeResultDisplay = document.getElementById("palindromeResult");

// Functie om een woord om te draaien
function reverseWord(word) {
    return word.split('').reverse().join('');
}

// Functie om te controleren of een woord een palindroom is
function isPalindrome(word) {
    var reversedWord = reverseWord(word);
    // Vergelijk het originele woord met het omgedraaide woord (case-insensitive)
    return word.toLowerCase() === reversedWord.toLowerCase();
}

// Voeg een klikgebeurtenis toe aan de knop
checkButton.onclick = function() {
    // Haal het woord uit het invoerveld
    var word = wordInput.value;

    // Controleer of er een woord is ingevoerd
    if (word.trim() === "") {
        reversedWordDisplay.innerText = "Vul een woord in!";
        palindromeResultDisplay.innerText = "";
        return;
    }

    // Roep de functies aan om het woord om te draaien en te controleren op palindroom
    var reversedWord = reverseWord(word);
    var palindromeCheck = isPalindrome(word);

    // Toon het omgedraaide woord
    reversedWordDisplay.innerText = reversedWord;

    // Toon of het een palindroom is
    if (palindromeCheck) {
        palindromeResultDisplay.innerText = "Ja, het is een palindroom!";
    } else {
        palindromeResultDisplay.innerText = "Nee, het is geen palindroom.";
    }
}


