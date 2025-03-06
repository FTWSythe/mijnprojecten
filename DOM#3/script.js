// Het geheime nummer wordt willekeurig gegenereerd tussen 1 en 100
var secretNumber = Math.floor(Math.random() * 100) + 1;

// We halen de invoer, knop en het resultaat-element op uit de HTML
var userInput = document.getElementById("userInput");
var checkButton = document.getElementById("checkButton");
var result = document.getElementById("result");

// Wanneer er op de knop wordt geklikt, wordt deze functie uitgevoerd
checkButton.onclick = function() {
    // Haal het getal op dat de gebruiker heeft ingevoerd en zet het om naar een getal
    var userGuess = parseInt(userInput.value);

    // Controleer of de invoer geldig is (geen leeg veld of tekst)
    if (isNaN(userGuess)) {
        result.innerText = "Voer een geldig getal in!";
        return; // Stop met de functie als het geen getal is
    }

    // Vergelijk de invoer van de gebruiker met het geheime getal
    if (userGuess > secretNumber) {
        result.innerText = "Het ingevoerde getal is te hoog!";
    } else if (userGuess < secretNumber) {
        result.innerText = "Het ingevoerde getal is te laag!";
    } else {
        result.innerText = "Gefeliciteerd! Je hebt het getal geraden!";
    }
}
