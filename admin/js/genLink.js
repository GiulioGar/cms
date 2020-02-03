
viewOt();

//FUNZIONE PER LE ALTRE VARIABILI
 function viewOt()
 {
 if($('#ot').prop('checked')) { $('.otVar').show();}
 else { $('.otVar').hide(); alter="";}
 }
 
 function soloNum()
 {
	var nl=$('#nLink').val();
  if (isNaN(nl)){$('span.alert').text('Attenzione:inserire un valore numerico').css('color','red');}
  else {$('span.alert').hide(); }
 }
 
$(document).ready(function() {
  $("#copy-link-wrap").zclip({
    path: 'zclip/ZeroClipboard.swf',
    copy: $('div#toclip').text(),
    afterCopy: function() {
      // console.log('copied');
      alert('Data in clipboard! Now you can paste it somewhere');
    }
  });
});
