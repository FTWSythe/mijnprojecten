var meerContentButton = document.getElementById('meerContentButton');
var minderContentButton = document.getElementById('minderContentButton');

meerContentButton.onclick = function() {
    var nieuweParagraaf = document.createElement('p');
    nieuweParagraaf.innerText = "Dit is meer content!";
    document.body.appendChild(nieuweParagraaf);
};


minderContentButton.onclick = function() {
    var paragrafen = document.getElementsByTagName('p');
    
    if (paragrafen.length > 0) {
        var laatsteParagraaf = paragrafen[paragrafen.length - 1];
        document.body.removeChild(laatsteParagraaf);
    }
};
