// Haal het HTML element voor de omhoog knop van het uur op
var hourUp = document.getElementById("js--hour-up");

// Haal het HTML element voor de omlaag knop van het uur op
var hourDown = document.getElementById("js--hour-down");

// Variabele voor het uur, begint bij 0
var hour = 0;

// Haal het HTML element op waar het uur wordt weergegeven
var timeHour = document.getElementById("js--time-hour");

// Voeg een klikgebeurtenis toe aan de omhoog knop voor het uur
hourUp.onclick = function(){
    // Verhoog het uur met 1
    hour += 1;
    // Reset het uur naar 0 als het groter is dan 23 (24-uurs formaat)
    if(hour > 23){
        hour = 0;
    }
    // Zorg ervoor dat het uur altijd tweecijferig is (bv. 09 in plaats van 9)
    if(hour < 10){
        timeHour.innerText = "0" + hour;
    }
    else{
        timeHour.innerText = hour;
    }
}

// Voeg een klikgebeurtenis toe aan de omlaag knop voor het uur
hourDown.onclick = function(){
    // Verlaag het uur met 1
    hour -= 1;
    // Zet het uur naar 23 als het lager is dan 0 (24-uurs formaat)
    if(hour < 0){
        hour = 23;
    }
    // Zorg ervoor dat het uur altijd tweecijferig is
    if(hour < 10){
        timeHour.innerText = "0" + hour;
    }
    else{
        timeHour.innerText = hour;
    }
}

// Variabele voor de minuten, begint bij 0
var minute = 0;

// Haal het HTML element op waar de minuten worden weergegeven
var timeMinute = document.getElementById("js--time-minute");

// Haal het HTML element voor de omhoog knop van de minuten op
var minuteUp = document.getElementById("js--minute-up");

// Voeg een klikgebeurtenis toe aan de omhoog knop voor de minuten
minuteUp.onclick = function(){
    // Verhoog de minuten met 1
    minute += 1;
    // Reset de minuten naar 0 als het groter is dan 59
    if(minute > 59){
        minute = 0;
    }
    // Zorg ervoor dat de minuten altijd tweecijferig zijn (bv. 09 in plaats van 9)
    if(minute < 10){
        timeMinute.innerText = "0" + minute;
    }
    else{
        timeMinute.innerText = minute;
    }
}

// Haal het HTML element voor de omlaag knop van de minuten op
var minuteDown = document.getElementById("js--minute-down");

// Voeg een klikgebeurtenis toe aan de omlaag knop voor de minuten
minuteDown.onclick = function(){
    // Verlaag de minuten met 1
    minute -= 1;
    // Zet de minuten naar 59 als het lager is dan 0
    if(minute < 0){
        minute = 59;
    }
    // Zorg ervoor dat de minuten altijd tweecijferig zijn
    if(minute < 10){
        timeMinute.innerText = "0" + minute;
    }
    else{
        timeMinute.innerText = minute;
    }
}

// Haal het HTML element op voor de aan/uit toggle van de alarmklok
var toggle = document.getElementById("js--toggle");

// Variabele om de timer op te slaan voor de interval die de tijd controleert
var timer = null;

// Variabele om de timeout van het dialoogvenster op te slaan
var getTimerout = null;

// Haal het HTML element op voor het dialoogvenster (alarm melding)
var dialogue = document.getElementById("js--dialogue");

// Maak een nieuw audio object voor het alarmgeluid
var audio = new Audio("/sounds/520674__zhr__relaxation-music-2.mp3");

// Zet standaard de toggle op ongecheckt (alarm uit)
toggle.checked = false;

// Voeg een veranderingsevent toe aan de toggle voor het alarm
toggle.onchange = function(){
    // Als de toggle wordt aangezet (alarm wordt ingeschakeld)
    if(toggle.checked === true){
        // Toon een bericht dat het alarm is ingesteld met het gekozen uur en minuten
        dialogue.innerText = "Je alarm is gezet om " + hour + " uur en " + minute + " minuten";
        // Voeg een CSS-klasse toe om aan te geven dat de toggle is ingeschakeld
        toggle.classList.add("alarm__toggle--checked");
        // Maak het dialoogvenster zichtbaar
        dialogue.style.display = "flex";
        // Verberg het dialoogvenster na 3,5 seconden
        getTimerOut = setTimeout(function(){
            dialogue.style.display = "none";
        }, 3500);
        // Start een interval die elke seconde de huidige tijd controleert
        timer = setInterval(function(){
            // Haal de huidige datum en tijd op
            var date = new Date();
            var dateHour = date.getHours();
            var dateMinute = date.getMinutes();
            // Als de huidige tijd overeenkomt met de ingestelde alarmtijd
            if(hour === dateHour && minute === dateMinute){
                // Speel het alarmgeluid af
                audio.play();
            }
        },1000);
    }
    // Als de toggle wordt uitgezet (alarm wordt uitgeschakeld)
    else{
        // Verberg het dialoogvenster
        dialogue.style.display = "none";
        // Verwijder de CSS-klasse voor ingeschakelde toggle
        toggle.classList.remove("alarm__toggle--checked");
        // Annuleer de timeout voor het dialoogvenster
        clearTimeout(getTimerout);
        // Stop de interval die de tijd controleert
        clearInterval(timer);
    }
}
