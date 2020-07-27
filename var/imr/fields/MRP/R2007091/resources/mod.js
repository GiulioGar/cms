function contorovescia(tempo)
{   
    $('#console').after("<div style='position:relative; top:20px' class='cdown'>&nbsp;</div>");
    
    let label;
    let secs;

    let fiveSeconds = new Date().getTime() + tempo;
    $('#bnNext').countdown(fiveSeconds, {elapse: true})
    .on('update.countdown', function(event) {
      let $this = $(this);
      if (event.elapsed) {
        $this.attr("disabled", false).css('opacity', '1');
        $(".cdown").hide();
      } else {
        $this.attr("disabled", true).css('opacity', '0.6');
        secs=event.strftime("%S");
        
        if(secs==1) {label="secondo"}
        else {label="secondi"}

        $(".cdown").html(event.strftime('Tra <span>%S</span> '+label+' potrà continuare.'));
      }
    });

}


