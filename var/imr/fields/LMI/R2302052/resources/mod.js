
function contorovescia(tempo) {
  $('#console').after("<div class='cdown'>&nbsp;</div>");

  let label;
  let secs;

  let fiveSeconds = new Date().getTime() + tempo;
  $('#bnNext').countdown(fiveSeconds, { elapse: true })
      .on('update.countdown', function(event) {
          let $this = $(this);
         
          if (event.elapsed) {
              $(".cdown").hide(); 
              $this.attr("disabled", false);
  
          } else {
              $this.attr("disabled", true);
              secs = event.strftime("%S");

              if (secs == 1) { label = "secondo" } else { label = "secondi" }
          

              $(".cdown").html(event.strftime('Tra <span>%S</span> ' + label + ' può proseguire.'));
          }
      });

} 	


function changeOrder()
{

  console.log("test3");
  let valRand=Math.floor(Math.random() * 10) + 1;



  
  if(valRand<6) 
  {

    var i;
    for (i = 1; i < 5; i++) {
      $("label[for='q"+i+"_opt0']").parent().insertAfter("label[for='q"+i+"_opt1']").parent();
    } 

   
  }
  console.log("Ordine"+valRand);







}


$(window).load(function() {  changeOrder(); });