function contorovescia(tempo) {
    $('#console').after("<div class='cdown'>&nbsp;</div>");

    // Get the browser language
var userLang = navigator.language || navigator.userLanguage;

// Define the text based on the language
var text1;
var text2;
var text3;
var text4;
if (userLang.startsWith('it')) {
    text1 = "secondo"; // I
    text2 = "secondi"; // Italian
    text3 = "Tra"; // Italian
    text4 = " potrà continuare"; // Italian
} else if (userLang.startsWith('en')) {
    text1 = "second"; // Inglese
    text2 = "seconds"; // Inglese
    text3 = "In"; // Inglese
    text4 = " you can continue"; // Inglese
} else if (userLang.startsWith('pl')) {
    text1 = "sekunda"; // polonia
    text2 = "sekundy"; // polonia
    text3 = "Za"; // polonia
    text4 = " możesz kontynuować"; // polonia
} else {
    text1 = "second"; // Inglese
    text2 = "seconds"; // Inglese
    text3 = "In"; // Inglese
    text4 = " you can continue"; // Inglese
}

    let label;
    let secs;

    let fiveSeconds = new Date().getTime() + tempo;
    $('#bnNext').countdown(fiveSeconds, { elapse: true })
        .on('update.countdown', function(event) {
            let $this = $(this);
            if (event.elapsed) {
                $this.attr("disabled", false);
                $(".cdown").hide();
                //$("#bnNext").click();
            } else {
                $this.attr("disabled", true);
                secs = event.strftime("%S");

                if (secs == 1) { label = text1 } else { label = text2 }

                $(".cdown").html(event.strftime(text3+' <span>%S </span> ' + label + text4+'.'));
            }
        });

}