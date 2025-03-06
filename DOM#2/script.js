// Selecteer de vakken en de reset-knop op basis van hun klasse
var leftBox = document.querySelector('.left');
var middleBox = document.querySelector('.middle');
var rightBox = document.querySelector('.right');
var resetBtn = document.querySelector('.reset-btn');

// Functie voor het veranderen van de achtergrondkleur van het linkervlak
leftBox.onclick = function() {
    leftBox.style.backgroundColor = leftBox.style.backgroundColor === 'yellow' ? 'red' : 'yellow';
};

// Functie voor het verbergen van het middelste vlak
middleBox.onclick = function() {
    middleBox.style.display = 'none';
};

// Functie voor het vergroten van het rechtervlak
rightBox.onclick = function() {
    rightBox.style.width = '400px';
    rightBox.style.height = '400px';
};

// Functie voor het resetten van de pagina naar de oorspronkelijke staat
resetBtn.onclick = function() {
    // Herstel de oorspronkelijke achtergrondkleur van het linkervlak
    leftBox.style.backgroundColor = 'red';

    // Laat het middelste vlak weer zien
    middleBox.style.display = 'block';

    // Zet het rechtervlak terug naar de oorspronkelijke grootte
    rightBox.style.width = '200px';
    rightBox.style.height = '200px';
};
