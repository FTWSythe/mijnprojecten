// Voeg een click event toe aan de "Toevoegen" knop om de addPassword functie aan te roepen
document.getElementById('addPasswordBtn').onclick = function() {
    addPassword();
};

// Functie om een nieuw wachtwoord toe te voegen aan de lijst
function addPassword() {
    var url = document.getElementById('url').value;  // Haal de URL/naam op uit het input veld
    var password = document.getElementById('password').value;  // Haal het wachtwoord op uit het input veld
    var passwordList = document.getElementById('passwordList');  // Haal de lijst van opgeslagen wachtwoorden op

    var passwordDiv = document.createElement('div');  // Maak een nieuw div element voor het wachtwoord
    passwordDiv.classList.add('password-item');  // Voeg een klasse toe voor styling
    
    var urlSpan = document.createElement('span');  // Maak een span element voor de URL/naam
    urlSpan.innerText = url + ": ";  // Zet de URL/naam in de span
    passwordDiv.appendChild(urlSpan);  // Voeg de URL/naam span toe aan het div element

    var textSpan = document.createElement('span');  // Maak een span element voor het wachtwoord
    textSpan.innerText = "********";  // Zet sterretjes als placeholder voor het wachtwoord
    passwordDiv.appendChild(textSpan);  // Voeg de wachtwoord span toe aan het div element
    passwordDiv.dataset.password = password;  // Sla het wachtwoord op in een data attribuut

    var showButton = document.createElement('button');  // Maak een knop om het wachtwoord te tonen
    showButton.innerText = "Show";  // Zet de tekst van de knop
    showButton.classList.add('show-btn');  // Voeg een klasse toe voor styling

    // Voeg een mousedown event toe om het wachtwoord te tonen
    showButton.onmousedown = function() {
        textSpan.innerText = passwordDiv.dataset.password;  
    };

    // Voeg een mouseup event toe om het wachtwoord weer te verbergen
    showButton.onmouseup = function() {
        textSpan.innerText = "********";  
    };

    // Voeg een mouseleave event toe om het wachtwoord weer te verbergen als de muis de knop verlaat
    showButton.onmouseleave = function() {
        textSpan.innerText = "********";  
    };

    var removeButton = document.createElement('button');  // Maak een knop om het wachtwoord te verwijderen
    removeButton.innerText = "Verwijder";  // Zet de tekst van de knop
    removeButton.classList.add('remove-btn');  // Voeg een klasse toe voor styling

    // Voeg een click event toe om het wachtwoord te verwijderen
    removeButton.onclick = function() {
        passwordList.removeChild(passwordDiv);  
    };

    // Voeg de show en verwijder knoppen toe aan het div element
    passwordDiv.appendChild(showButton);  
    passwordDiv.appendChild(removeButton);  
    // Voeg het div element toe aan de lijst van opgeslagen wachtwoorden
    passwordList.appendChild(passwordDiv);  
}

// Voeg een click event toe aan de "Swap Cards" knop om de swapCards functie aan te roepen
document.getElementById('swapButton').onclick = function() {
    swapCards();
};

var swapped = false;  // Variabele om de huidige positie van de kaarten bij te houden

// Functie om de input en output kaarten te wisselen
function swapCards() {
    var inputCard = document.getElementById('inputCard');  // Haal de input kaart op
    var outputCard = document.getElementById('outputCard');  // Haal de output kaart op
    var parent = inputCard.parentElement;  // Haal de ouder van de kaarten op

    // Verwijder beide kaarten uit de DOM
    parent.removeChild(inputCard);
    parent.removeChild(outputCard);

    // Voeg de kaarten opnieuw toe in omgekeerde volgorde
    if (swapped) {
        parent.appendChild(inputCard);
        parent.appendChild(outputCard);
    } else {
        parent.appendChild(outputCard);
        parent.appendChild(inputCard);
    }
    swapped = !swapped;  // Wissel de waarde van swapped

    // Voeg de event opnieuw toe na het wisselen van de kaarten
    updateEvents();
}

// Functie om de event voor de show knoppen opnieuw toe te voegen
function updateEvents() {
    var showButtons = document.getElementsByClassName('show-btn');  // Haal alle show knoppen op
    for (var i = 0; i < showButtons.length; i++) {
        // Voeg een mousedown event toe om het wachtwoord te tonen
        showButtons[i].onmousedown = function() {
            var passwordDiv = this.parentElement;
            var textSpan = passwordDiv.getElementsByTagName('span')[1];
            textSpan.innerText = passwordDiv.dataset.password;  
        };

        // Voeg een mouseup event toe om het wachtwoord weer te verbergen
        showButtons[i].onmouseup = function() {
            var passwordDiv = this.parentElement;
            var textSpan = passwordDiv.getElementsByTagName('span')[1];
            textSpan.innerText = "********";  
        };

        // Voeg een mouseleave event toe om het wachtwoord weer te verbergen als de muis de knop verlaat
        showButtons[i].onmouseleave = function() {
            var passwordDiv = this.parentElement;
            var textSpan = passwordDiv.getElementsByTagName('span')[1];
            textSpan.innerText = "********";  
        };
    }
}
