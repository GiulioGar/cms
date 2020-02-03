<?php
				
	ini_set("SMTP", "smtps.aruba.it");		
				
			
				
				
				
				$header = "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$header .= 'From: "Mybeautylab" <info@mybeautylab.org>';
				$destinatario = 'giuliogarofalo83@gmail.com';
				$oggetto = "Club Millebytes: Ecco il tuo buono regalo!";
				$messaggio = '
				<html>
				<head>
				<title>Club Millebytes: Ecco il tuo buono regalo!</title>
				<style type="text/css">
				body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
				</style>
				</head>
				<body>
				<p>&Egrave; con grande piacere che ti inviamo il Buono Regalo* Amazon.it che potrai utilizzare per comprare milioni di articoli
				su <a href="http://www.amazon.it">www.amazon.it</a>. Non cancellare questo messaggio, avrai bisogno del codice del Buono Regalo riportato qui sotto. 
				Ti consigliamo di stampare una copia del presente messaggio per riferimenti futuri.</p><br>
				
				<p>
				<b>Codice Buono Regalo* Amazon.it: </b><br>
				<b>Importo: </b><br>
				<b>Validità: 10 anni</b><br>
				</p>
				<br>
				
				<p>
				Per utilizzare il tuo Buono Regalo, segui questa procedura:
				<ol>
				<li>Vai su <a href="http://www.amazon.it/gp/gc/">www.amazon.it/gp/gc/</a></li>
				<li>Clicca su &quot;Aggiungi al mio Account&quot; e inserisci il codice quando richiesto.</li>
				<li>Il credito del Buono Regalo sar&agrave; aggiunto automaticamente agli ordini &quot;alla cassa&quot;.</li>
				<li>Il saldo del tuo ordine eccedente l&apos;importo del Buono Regalo va estinto con un&apos;altra modalit&agrave; di pagamento.</li>
				</ol>
				
				<br>
				
				Il codice del tuo Buono Regalo pu&ograve;  essere inserito anche quando gli ordini sono &quot;alla cassa&quot;. Per utilizzare il tuo Buono Regalo usando l&apos;opzione 1-Click&reg; di Amazon, per prima cosa inserisci il credito del Buono Regalo al tuo Account.
				
				</p>
				
				<p>
				Per informazioni su come utilizzare il tuo Buono Regalo, visita la pagina <a href="http://www.amazon.it/aiuto">www.amazon.it/aiuto</a>. Per informazioni sull&apos;offerta della societ&agrave; Millebytes, contatta la societ&agrave; Millebytes.
				</p>
				
				<p>
				Lascia un commento sulla nostra pagina facebook !<a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
				</p>
				
				<br>
				<p>
				*Amazon.it non &egrave; uno sponsor della presente promozione. I Buoni Regalo Amazon.it possono essere utilizzati sul sito Amazon.it per l&apos;acquisto di prodotti elencati nel nostro catalogo on-line e venduti da Amazon.it o da qualsiasi altro venditore attraverso Amazon.it I Buoni Regalo Amazon non possono essere ricaricati, rivenduti, convertiti in contanti, trasferiti o utilizzati in un altro account. Amazon.it non &egrave; responsabile per lo smarrimento, il furto, la distruzione o l&apos;uso non autorizzato dei Buoni Regalo. I termini e condizioni d&apos;uso sono disponibili su <a href="http://www.amazon.it/buoni-regalo-termini-condizioni">www.amazon.it/buoni-regalo-termini-condizioni</a>. I Buoni Regalo sono emessi da Amazon EU Sarl. Tutti i &reg;, TM e &copy; Amazon sono propriet&agrave; intellettuale di Amazon.com o delle sue filiali.
				</p>
				
				
				
				</body>
				</html>
				';
				mail($destinatario, $oggetto, $messaggio, $header);
				
				$contapagati2euro=$contapagati2euro+1;
			
			
		
?>			