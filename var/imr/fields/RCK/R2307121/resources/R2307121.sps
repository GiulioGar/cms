DATA LIST FILE 'R2307121.txt' LIST(";") /
IID (F4) UID (A25) STIME (A25) ETIME (A25) LENGTH (F4) ECODE (A25) LASTVIEW (A25) q20 (F4) S1 (F4) S2 (A256) q50 (F4) s3 (F4) recarea (F4) S4 (F4) s5 (F4) S6_0 (F4) S6_1 (F4) 
S6_2 (F4) S6_3 (F4) S6_4 (F4) S6_5 (F4) S6_6 (F4) S6tom (F4) Q1.0_0 (F4) Q1.0_1 (F4) Q1.0_2 (F4) Q1.0_3 (F4) 
Q1.0_4 (F4) Q1.0_5 (F4) Q1.0_6 (F4) Q1.0tom (F4) XQ1.0_6 (A256) Q1.1 (F4) XQ1.1_6 (A256) q2.0 (F4) q2.1 (F4) q2.2 (F4) 
QB (F4) QC (F4) QD_0 (F4) QD_1 (F4) QD_2 (F4) QD_3 (F4) QD_4 (F4) QDtom (F4) QE (F4) XQE_11 (A256) 
QF (F4)
.
VARIABLE LABELS
	IID "Interview Identifier"
	UID "User Identifier"
	STIME "Start Time"
	ETIME "End Time"
	LENGTH "Length (secs)"
	ECODE "Exit Code"
	LASTVIEW "Last View"
	q20 "q20: Partecipando a questa ricerca avrà accesso a informazioni riservate legate allo sviluppo di idee e proposte per nuovi prodotti.Le chiediamo di non utilizzare o divulgare a nessuno le informazioni di cui verrà a conoscenza, non copiare, fotografare, stampare o scaricare alcuna informazione accessibile nel corso di questo studio.Selezionando “Accetto” qui sotto, dichiara di aver letto, compreso e accettato questi termini."
	S1 "S1: Come prima cosa Le chiediamo di rispondere ad alcune domande introduttive.Lei è…"
	S2 "S2: Quanti anni ha?"
	q50 "q50: CODIFICARE"
	s3 "s3: In quale regione vive?"
	recarea "recarea: Ricodifica"
	S4 "S4: Chi si occupa degli acquisti di prodotti per la pulizia delle stoviglie in casa?"
	s5 "s5: Chi si occupa principalmente dell’utilizzo della lavastoviglie in casa sua?"
	S6_0 "S6: Detersivo liquido/in gel per lavastoviglie"
	S6_1 "S6: Pastiglie per lavastoviglie"
	S6_2 "S6: Cura lavastoviglie"
	S6_3 "S6: Additivo brillantante per lavastoviglie"
	S6_4 "S6: Detersivo liquido per piatti"
	S6_5 "S6: Sgrassatore"
	S6_6 "S6: Nessuno di questi prodotti"
	S6tom "S6: Top of Mind"
	Q1.0_0 "Q1.0: Finish"
	Q1.0_1 "Q1.0: Pril"
	Q1.0_2 "Q1.0: Fairy"
	Q1.0_3 "Q1.0: Svelto"
	Q1.0_4 "Q1.0: Winni’s"
	Q1.0_5 "Q1.0: Marca del supermercato"
	Q1.0_6 "Q1.0: Altra marca (specificare)"
	Q1.0tom "Q1.0: Top of Mind"
	XQ1.0_6 "Q1.0: Altra marca (specificare)"
	Q1.1 "Q1.1: E qual è la marca che acquista più spesso?"
	XQ1.1_6 "Q1.1: Altra marca (specificare)"
	q2.0 "q2.0: Il tuo browser non supporta i contenuti video HTML5Quale delle seguenti frasi meglio descrive cosa vuole comunicare questo spot?"
	q2.1 "q2.1: Il tuo browser non supporta i contenuti video HTML5Questo spot si chiude con la seguente affermazione “Passando al ciclo Eco con Pril Excellence puoi risparmiare il 20% di energia”. Secondo lei, comunica che il risparmio di energia è legato:"
	q2.2 "q2.2: Il tuo browser non supporta i contenuti video HTML5Aveva già visto in passato lo spot Pril che le abbiamo precedentemente mostrato?"
	QB "QB: Da quante persone è composta la Sua famiglia, inclusa Lei stessa?"
	QC "QC: Ci sono bambini / ragazzi fino a 18 anni nella sua famiglia? Se si, quanti? "
	QD_0 "QD: Fino a 3 anni"
	QD_1 "QD: Dai 3 ai 7 anni"
	QD_2 "QD: Dai 7 a 10 anni"
	QD_3 "QD: Dai 11 a 14 anni"
	QD_4 "QD: Dai 15 a 18 anni"
	QDtom "QD: Top of Mind"
	QE "QE: Qual è la sua attuale professione?"
	XQE_11 "QE: Altro (specificare)"
	QF "QF: Qual è il tuo titolo di studio?"
.
VALUE LABELS
	q20
		1 "Accetta"
		2 "Declina"
	/
	S1
		1 "Uomo"
		2 "Donna"
	/
	q50
		1 "Meno di 25"
		2 "25 - 34"
		3 "35 - 44"
		4 "45 - 54"
		5 "55-65"
		6 "Più di 65"
	/
	s3
		1 "Valle d’Aosta"
		2 "Piemonte"
		3 "Lombardia"
		4 "Liguria"
		5 "Veneto"
		6 "Friuli V.G."
		7 "Trentino A.A."
		8 "Emilia Romagna"
		9 "Toscana"
		10 "Marche"
		11 "Umbria"
		12 "Lazio"
		13 "Abruzzo"
		14 "Molise"
		15 "Campania"
		16 "Puglia"
		17 "Basilicata"
		18 "Sardegna"
		19 "Calabria"
		20 "Sicilia"
	/
	recarea
		1 "Nord Ovest"
		2 "Nord est"
		3 "Centro"
		4 "Sud e Isole"
	/
	S4
		1 "Io personalmente"
		2 "Io e il mio coniuge/altre persone insieme"
		3 "Il mio coniuge/altre persone non sono responsabile"
	/
	s5
		1 "Io personalmente"
		2 "Io con mio marito/moglie/partner/ altri"
		3 "Altre persone"
		4 "Non possiedo la lavastoviglie in casa"
	/
	S6_0 TO S6_6
		0 Not Mentioned
		1 Mentioned
	/
	Q1.0_0 TO Q1.0_6
		0 Not Mentioned
		1 Mentioned
	/
	Q1.1
		1 "Finish"
		2 "Pril"
		3 "Fairy"
		4 "Svelto"
		5 "Winni’s"
		6 "Marca del supermercato"
		7 "Altra marca (specificare)"
	/
	q2.0
		1 "Che il ciclo ECO in presenza di sporco ostinato non permette una corretta pulizia delle stoviglie che è invece garantita se utilizzo Pril Excellence"
		2 "Che il ciclo ECO in presenza di sporco ostinato consente una corretta pulizia delle stoviglie solo se utilizzo anche Pril Excellence"
		3 "Che il ciclo ECO in presenza di sporco ostinato funziona sempre a prescindere dal detersivo per lavastoviglie che utilizzo"
	/
	q2.1
		1 "Al solo Ciclo ECO"
		2 "A Pril Excellence"
		3 "Alla combinazione di entrambi"
	/
	q2.2
		1 "Sì, lo avevo già visto"
		2 "No, non lo avevo mai visto prima"
	/
	QB
		1 "Una"
		2 "Due"
		3 "Tre"
		4 "Quattro"
		5 "Cinque"
		6 "Sei o più"
	/
	QC
		1 "Uno"
		2 "Due"
		3 "Tre"
		4 "Quattro"
		5 "Cinque"
		6 "Sei o più"
		7 "Nessuno"
	/
	QD_0 TO QD_4
		0 Not Mentioned
		1 Mentioned
	/
	QE
		1 "Dirigente, imprenditore, libero professionista"
		2 "Insegnante"
		3 "Impiegato"
		4 "Commerciante/esercente (in proprio)"
		5 "Commerciante/esercente (alle dipendenze di altri)"
		6 "Artigiano"
		7 "Operaio"
		8 "Studente"
		9 "Casalinga"
		10 "In cerca di prima occupazione"
		11 "Disoccupato"
		12 "Altro (specificare)"
	/
	QF
		1 "Nessun titolo/Scuola primaria"
		2 "Diploma di scuola media"
		3 "Diploma di scuola superiore"
		4 "Laurea/Laurea triennale"
		5 "Post Laurea"
	/
.
