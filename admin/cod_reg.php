<?php
$arView=0;
$reView=0;

	// Codifica per regioni e aree
	switch ($proView) 
	{

//abr

case 24:
case 41:
case 66:
case 88:


	$reView=1;
	$arView=4;
	$reStamp="Abruzzo";
	$arStamp="Sud";

	break;

//bas

case 52:
case 71:

	$reView=2;
	$arView=4;
	$reStamp="Basilicata";
	$arStamp="Sud";

	break;

//cal

case 23:
case 26:
case 28:
case 75:
case 101:


	$reView=3;
	$arView=4;
	$reStamp="Calabria";
	$arStamp="Sud";

	break;
	
//cam

case 8:
case 11:
case 21:
case 56:
case 81:


	$reView=4;
	$arView=4;

	$reStamp="Campania";
	$arStamp="Sud";

	break;
//emi

case 14:
case 31:
case 34:
case 55:
case 62:
case 67:
case 74:
case 76:
case 78:


	$reView=5;
	$arView=2;

	$reStamp="Emila Romagna";
	$arStamp="Nord Est";

	break;

//fri

case 37:
case 70:
case 94:
case 95:


	$reView=6;
	$arView=2;

	$reStamp="Friuli";
	$arStamp="Nord Est";

	break;

//laz

case 35:
case 43:
case 77:
case 79:
case 103:


	$reView=7;
	$arView=3;

	$reStamp="Lazio";
	$arStamp="Centro";

	break;



//lig

case 36:
case 39:
case 42:
case 83:


	$reView=8;
	$arView=1;

	$reStamp="Liguria";
	$arStamp="Nord Ovest";

	break;

//lom

case 12:
case 16:
case 25:
case 27:
case 45:
case 47:
case 50:
case 54:
case 61:
case 63:
case 86:
case 96:


	$reView=9;
	$arView=1;

	
	$reStamp="Lombardia";
	$arStamp="Nord Ovest";
	
	break;

//Marche

case 3:
case 6:
case 105:
case 49:
case 65:


	$reView=10;
	$arView=3;

	
	$reStamp="Marche";
	$arStamp="Centro";

	break;

//Molise

case 20:
case 40:

	$reView=11;
	$arView=4;
	
	$reStamp="Molise";
	$arStamp="Sud";
	


	break;

//Piemonte

case 2:
case 7:
case 13:
case 29:
case 57:
case 90:
case 98:
case 99:


	$reView=12;
	$arView=1;

	$reStamp="Piemonte";
	$arStamp="Nord Ovest";

	break;

//Puglia

case 9:
case 17:
case 33:
case 44:
case 87:
case 106:	


	$reView=13;
	$arView=4;

	$reStamp="Puglia";
	$arStamp="Sud";

	break;
	
//Sardegna

case 18:
case 58:
case 59:
case 82:


	$reView=14;
	$arView=4;

	$reStamp="Sardegna";
	$arStamp="Sud";

	break;
	
//Sicilia


case 19:
case 22:
case 30:
case 53:
case 61:
case 73:
case 85:
case 91:
case 1:

	$reView=15;
	$arView=4;

	$reStamp="Sicilia";
	$arStamp="Sud";

	break;
	
//Toscana

case 5:
case 32:
case 38:
case 46:
case 48:
case 51:
case 68:
case 69:
case 72:
case 84:

	$reView=16;
	$arView=3;

	$reStamp="Toscana";
	$arStamp="Centro";

	break;
	
//Trentino-Alto Adige

case 15:
case 92:

	$reView=17;
	$arView=2;

	$reStamp="Trentino";
	$arStamp="Nord Est";

	break;
	
//Umbria

case 46:
case 64:
case 89:

	$reView=18;
	$arView=3;

	$reStamp="Umbria";
	$arStamp="Centro";
	break;

//Aosta
case 4:

	$reView=19;
	$arView=1;

	$reStamp="Valle d'Aosta";
	$arStamp="Nord Ovest";

	break;
	
//Veneto

case 10:
case 60:
case 80:
case 93:
case 97:
case 100:
case 102:


	$reView=20;
	$arView=2;

	$reStamp="Veneto";
	$arStamp="Nord Est";

	


	}
?>



                                
