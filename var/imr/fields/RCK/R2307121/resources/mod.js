

function barColor()
{

    $(".slider-header").hide();
    $(".slider-header").fadeIn(1400);

    $(".ui-widget-content") .css("background","#fff");
    $("#console") .css("margin-left","40%");
    
    let vleft;
    var position;
    let position1;


    $('#bnNext').attr('disabled', 'disabled').css('opacity', 0.5); $('#erroreMsg').show().insertBefore('#console');

    $( ".label-min" ).html( $( ".sad" ) );
    $( ".label-max" ).html( $( ".happy" ) );


    $( '.slider' ).slider({change: function( event, ui ) {
        poistion="";
        position=$('.ui-slider .ui-slider-handle').text();
        position1=position-1;
        console.log("posizione:"+position);
        $('#bnNext').removeAttr('disabled').css('opacity', 1);  $('#erroreMsg').hide();


        $(".ui-widget-content") .css("background","#fff");


     if(position<=20) { $('.ui-widget-content').css({ background: "linear-gradient(to right, #cc0000 0%, #fff "+position1+"%)" }); }
      
    if(position>=21 && position<=40) { $('.ui-widget-content').css({ background: "linear-gradient(to right, #cc0000 0%, #ff9e3d "+position+"%,  #fff "+position1+"%)" }); }
    if(position>=41 && position<=60) { $('.ui-widget-content').css({ background: "linear-gradient(to right, #cc0000 0%, #ff9e3d 40%, #f4fc00 "+position+"%,#fff "+position1+"%)" }); }
    if(position>=61 && position<=80) { $('.ui-widget-content').css({ background: "linear-gradient(to right,#cc0000 0%, #ff9e3d 40%, #f4fc00 60%,#90ff19 "+position+"% ,#fff "+position1+"%)" }); }
    if(position>80) { $('.ui-widget-content').css({ background: "linear-gradient(to right, #cc0000 0%,  #ff9e3d 40%, #f4fc00 60%,#90ff19 80%,#007515 "+position+"% , #fff "+position1+"%)" }); }
       /*
       //smile color
       if(position<=50){ $('.sad').css({color:"#be0101"});  }
       else { $('.sad').css({color:"#adadad"}); }

       if(position>50){ $('.happy').css({color:"#029016"});  }
       else { $('.happy').css({color:"#adadad"}); }
    */

    }
    });

}



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
            

                $(".cdown").html(event.strftime('Tra <span>%S</span> ' + label + ' potrà proseguire con il sondaggio.'));
            }
        });

} 	


function nonumeri3() 
{
    let numvalid;
    let numslide=$( ".ui-slider .ui-slider-handle" ).length;
   
    $('#bnNext').attr('disabled', 'disabled').css('opacity', 0.5); $('#erroreMsg').show().insertBefore('#console');
    jQuery(".slider").slider({
       
     
        min: 0,
        max: 22 - 1,
        slide: function (event, ui) {
            var id = jQuery(this).attr("id"),
                val = ui.value;
            jQuery(ui.handle).text(val);
            jQuery(ui.focus).remove();
            jQuery("#group_"+id).val(val);
            
        }
       
    });

    $( ".ui-slider .ui-slider-handle" ).each(function() 
    {
        $(this).css("left","49.5%");
        $(this).filter("a").text("-");
    });

    
    let originalPos=$(".ui-slider .ui-slider-handle").position().left;

    $( '.slider' ).slider({change: function( event, ui ) {
  
    //$( ".container" ).mousemove(function()
    //{
        numvalid=0;

    $( ".ui-slider .ui-slider-handle" ).each(function() 
        {
        
        let pleft=$(this).position().left;
        if (pleft!= originalPos) {numvalid++;}
        console.log("pleft "+pleft);
        });

        console.log("validi "+numvalid);
        console.log("slide "+numvalid);
       

        if (numvalid != numslide) { $('#bnNext').attr('disabled', 'disabled').css('opacity', 0.5); $('#erroreMsg').show().insertBefore('#console');}
        else { $('#bnNext').removeAttr('disabled').css('opacity', 1);  $('#erroreMsg').hide();}
    }
    });
}