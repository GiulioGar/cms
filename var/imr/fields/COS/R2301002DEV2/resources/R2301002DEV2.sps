DATA LIST FILE 'R2301002DEV2.txt' LIST(";") /
IID (F4) UID (A25) STIME (A25) ETIME (A25) LENGTH (F4) ECODE (A25) LASTVIEW (A25) Svar0 (A25)Svar1 (A25)Svar2 (A25)Svar3 (A25)Svar4 (A25)Svar5 (A25)dcg (A25)mobile (A25)pan (A25)psid (A25)pid (A25) s1 (F4) s2 (F4) s2rec (F4) s3 (A256) s3rec (F4) q1 (F4) q2 (F4) q3 (F4) q4_0 (F4) q4_1 (F4) 
q4_2 (F4) q4_3 (F4) q4_4 (F4) q4_5 (F4) q4_6 (F4) q4tom (F4) Xq4_5 (A256) s14 (A256) s15_0 (F4) s15_1 (F4) 
s15tom (F4) Xs15_0 (A256) Xs15_1 (A256) s16_0 (F4) s16_1 (F4) s16_2 (F4) s16_3 (F4) s16_4 (F4) s16_5 (F4) s16tom (F4) 
Xs16_5 (A256) s17_0 (F4) s17_1 (F4) s17_2 (F4) s17_3 (F4) s18 (F4) s19 (F4) recDCG_0 (F4) recDCG_1 (F4) recDCG_2 (F4) 
recDCG_3 (F4) recDCG_4 (F4) recDCG_5 (F4) recDCGtom (F4) recIndici_0 (F4) recIndici_1 (F4) recIndici_2 (F4) recIndici_3 (F4) recIndici_4 (F4) recIndici_5 (F4) 
recIndici_6 (F4) recIndici_7 (F4) recIndici_8 (F4) recIndicitom (F4) qb1.0_0 (F4) qb2.0_0 (F4) qb3.0_0 (F4) qb4.0_0 (F4) qb4.0_1 (F4) qb4.0_2 (F4) 
qb4.0_3 (F4) qb4.0_4 (F4) qb4.0_5 (F4) qb1.1_0 (F4) qb2.1_0 (F4) qb3.1_0 (F4) qb4.1_0 (F4) qb4.1_1 (F4) qb4.1_2 (F4) qb4.1_3 (F4) 
qb4.1_4 (F4) qb4.1_5 (F4) qb1.2_0 (F4) qb2.2_0 (F4) qb3.2_0 (F4) qb4.2_0 (F4) qb4.2_1 (F4) qb4.2_2 (F4) qb4.2_3 (F4) qb4.2_4 (F4) 
qb4.2_5 (F4) qb1.3_0 (F4) qb2.3_0 (F4) qb3.3_0 (F4) qb4.3_0 (F4) qb4.3_1 (F4) qb4.3_2 (F4) qb4.3_3 (F4) qb4.3_4 (F4) qb4.3_5 (F4) 
qb1.4_0 (F4) qb2.4_0 (F4) qb3.4_0 (F4) qb4.4_0 (F4) qb4.4_1 (F4) qb4.4_2 (F4) qb4.4_3 (F4) qb4.4_4 (F4) qb4.4_5 (F4) qb1.5_0 (F4) 
qb2.5_0 (F4) qb3.5_0 (F4) qb4.5_0 (F4) qb4.5_1 (F4) qb4.5_2 (F4) qb4.5_3 (F4) qb4.5_4 (F4) qb4.5_5 (F4) r1_0 (F4) r1_1 (F4) 
r1_2 (F4) r1_3 (F4) r1_4 (F4) r1_5 (F4) r1a (A256) d1 (F4) d2 (F4) d2a (F4) d3 (F4) d4 (F4)

.
VARIABLE LABELS
	IID "Interview Identifier"
	UID "User Identifier"
	STIME "Start Time"
	ETIME "End Time"
	LENGTH "Length (secs)"
	ECODE "Exit Code"
	LASTVIEW "Last View"
	Svar0 "Svar0"
	Svar1 "Svar1"
	Svar2 "Svar2"
	Svar3 "Svar3"
	Svar4 "Svar4"
	Svar5 "Svar5"
	dcg "dcg"
	mobile "mobile"
	pan "pan"
	psid "psid"
	pid "pid"
	s1 "s1: Sie sind"
	s2 "s2: In welcher Region leben Sie zurzeit?"
	s2rec "s2rec: In quale regione vivi attualmente?"
	s3 "s3: Würden Sie bitte Ihr Alter angeben?"
	s3rec "s3rec: receta"
	q1 "q1: Sprechen wir nun kurz über Urlaub.Haben Sie in den letzten 12 Monaten mindestens 4 Tage Ferien gemacht?"
	q2 "q2: Haben Sie jemals eine Kreuzfahrt (auf einem Kreuzfahrtschiff) unternommen, zumindest einmal in Ihrem Leben?"
	q3 "q3: Wie würden Sie Ihr Interesse für eine Kreuzfahrt in den nächten 2-3 Jahren bezeichnen?"
	q4_0 "q4: Costa Kreuzfahrten"
	q4_1 "q4: MSC Kreuzfahrten"
	q4_2 "q4: Royal Caribbean"
	q4_3 "q4: Aida Kreuzfahrten"
	q4_4 "q4: TUI Kreuzfahrten"
	q4_5 "q4: Sonstige (bitte angeben)"
	q4_6 "q4: Keine davon"
	q4tom "q4: Top of Mind"
	Xq4_5 "q4: Sonstige (bitte angeben)"
	s14 "s14: $(document).ready(function() {$('input.form-control').attr('type', 'number');$('input.form-control').attr({'min' :1});});Kommen wir nun zu Ihrem letzten Urlaub, den Sie gemacht haben, worunter eine Reise mit mindestens 4 Übernachtungen außer Haus zu verstehen ist. Wie viele Personen waren an dieser Reise beteiligt, einschließlich Ihnen? Hinweis: Berücksichtigen Sie dabei nur Ihren Partner/Ihre Angehörigen, die Sie während des Aufenthalts begleitet haben. "
	s15_0 "s15: Kinder/Jugendliche (weniger als 18)"
	s15_1 "s15: AdulErwachseneti"
	s15tom "s15: Top of Mind"
	Xs15_0 "s15: Kinder/Jugendliche (weniger als 18)"
	Xs15_1 "s15: AdulErwachseneti"
	s16_0 "s16: Mein Partner (Ehemann/Ehefrau, Lebensgefährte/in, Verlobte/r)"
	s16_1 "s16: Freunde"
	s16_2 "s16: Kinder (volljährig)"
	s16_3 "s16: Andere Verwandte (z. B. Eltern, Tanten und Onkel, Cousins/en, Geschwister,…)"
	s16_4 "s16: Kollegen oder Mitglieder von Gruppen, bei denen auch ich Mitglied bin (z. B. Sportverbände…)"
	s16_5 "s16: Sonstiges"
	s16tom "s16: Top of Mind"
	Xs16_5 "s16: Sonstiges"
	s17_0 "s17: Ich suche immer die preiswerteste Lösung für meinen Urlaub, auch wenn ich dabei einige Kompromisse machen muss "
	s17_1 "s17: Ich mag es, mir einen gewissen Luxus zu gönnen"
	s17_2 "s17: Ich bin immer auf der Suche nach neuen Orten"
	s17_3 "s17: Komfort und Entspannung sind grundlegende Aspekte für jeden Urlaub"
	s18 "s18: Wenn Sie an Ihren idealen Urlaub denken, welche der folgenden Beschreibungen würde Ihren Bedürfnissen am ehesten entsprechen?"
	s19 "s19: Angenommen, Sie kaufen eine Kreuzfahrt, mit wem würden Sie in einer Kabine wohnen?"
	recDCG_0 "recDCG: EXPLORING COUPLES"
	recDCG_1 "recDCG: EXPLORING COUPLES bis"
	recDCG_2 "recDCG: SILVER EXPLORER"
	recDCG_3 "recDCG: SILVER EXPLORER bis"
	recDCG_4 "recDCG: EXPLORING TOGETHER FAMILIES"
	recDCG_5 "recDCG: OTHER"
	recDCGtom "recDCG: Top of Mind"
	recIndici_0 "recIndici: Costa ist die beste Art und Weise, Land und Meer in demselben Urlaub zu erkunden. Nur mit Costa können Sie jeden Tag an einem neuen Ort aufwachen und das Beste von ihm entdecken. Und dank der speziellen ALL-INCLUSIVE Formel ist alles enthalten. Sie brauchen daher an nichts anderes zu denken als an Ihre Reise."
	recIndici_1 "recIndici: Costa ist die beste Art und Weise, Land und Meer in demselben Urlaub zu erkunden. Lassen Sie Ihr Portemonnaie zu Hause, denn mit der ALL-INCLUSIVE Formel entdecken Sie sorgenfrei die schönsten Reiseziele unserer exklusiven Costa-Reiserouten."
	recIndici_2 "recIndici: Costa ist die beste Art und Weise, die Welt zu entdecken. Tagsüber entdecken Sie die Schönheiten der Städte, und beim Abendessen an Bord tauchen Sie in ihre kulinarischen Traditionen ein. Und all das ist in der speziellen ALL-INCLUSIVE Formel enthalten. Sie müssen daher an nichts anderes denken und können Ihre Erlebnisse in vollen Zügen genießen."
	recIndici_3 "recIndici: Costa ist die Reise, von der Sie immer mit einem Gefühl der Bereicherung zurückkehren. Nur bei Costa haben Sie die Möglichkeit, in die Kultur des Ortes einzutauchen und die sich ständig ändernden Farben, Klänge und Düfte zu entdecken. Dank der speziellen ALL-INCLUSIVE Formel können Sie dabei Ihr Portemonnaie in der Kabine lassen: Sie brauchen an nichts anderes zu denken als an Ihre Reise."
	recIndici_4 "recIndici: Costa steckt voller Wunder. Sie entdecken jeden Tag neue Sonnenauf- und -untergänge sowie Geräusche, von denen man nicht einmal dachte, dass es sie gibt. Und all das, während Sie Ihr Portemonnaie in der Kabine lassen: Dank der speziellen ALL-INCLUSIVE Formel brauchen Sie an nichts anderes zu denken als an Ihre Reise."
	recIndici_5 "recIndici: Costa ist der Inbegriff von gemeinsamem Urlaub. Erleben Sie Ihre Reise und staunen Sie gemeinsam über neue Perspektiven, Lichter und Farben. Und dank der speziellen ALL-INCLUSIVE Formel lassen Sie Ihr Portemonnaie in der Kabine, so dass Sie die schönsten Momente Ihres Urlaubs miteinander erleben können, ohne an etwas anderes als an Ihre Reise denken zu müssen."
	recIndici_6 "recIndici: Costa schenkt Ihnen jenes Gefühl von Freiheit, von dem Sie dachten, dass es in einem Urlaub nicht möglich sei. Nur mit Costa finden Sie die typisch italienische Flexibilität: Sie haben sogar die Freiheit, dank der speziellen ALL-INCLUSIVE Formel mit inbegriffenen Getränken und Landausflügen Ihre Brieftasche in der Kabine zu lassen und sich nur darum zu kümmern, die Reise an die schönsten Reiseziele voll auszukosten."
	recIndici_7 "recIndici: Costa ist der einzige Urlaub, der Meer und Land auf rein italienische Weise verbindet. Sie werden jeden Tag an einem neuen Ort aufwachen und viel Zeit zu haben, um die Reiseziele ihrem Rhythmus folgend und ohne Zeitdruck zu genießen."
	recIndici_8 "recIndici: Costa ist das Wunder, jeden Tag die Geheimnisse einzigartiger Orte anhand der Emotionen des Meeres zu entdecken. Sie folgen dabei immer dem entspannten Rhythmus und dem Wunsch nach authentischen Erfahrungen, die einen echten Urlaub in Italien auszeichnen."
	recIndicitom "recIndici: Top of Mind"
	qb1.0_0 "qb1.0:  "
	qb2.0_0 "qb2.0:  "
	qb3.0_0 "qb3.0:  "
	qb4.0_0 "qb4.0: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.0_1 "qb4.0: Sie ist klar und leicht verständlich"
	qb4.0_2 "qb4.0: Sie passt für eine Kreuzfahrt"
	qb4.0_3 "qb4.0: Sie ist für die Marke Costa Crociere passend"
	qb4.0_4 "qb4.0: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.0_5 "qb4.0: Es weckt mein Interesse, mehr zu erfahren"
	qb1.1_0 "qb1.1:  "
	qb2.1_0 "qb2.1:  "
	qb3.1_0 "qb3.1:  "
	qb4.1_0 "qb4.1: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.1_1 "qb4.1: Sie ist klar und leicht verständlich"
	qb4.1_2 "qb4.1: Sie passt für eine Kreuzfahrt"
	qb4.1_3 "qb4.1: Sie ist für die Marke Costa Crociere passend"
	qb4.1_4 "qb4.1: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.1_5 "qb4.1: Es weckt mein Interesse, mehr zu erfahren"
	qb1.2_0 "qb1.2:  "
	qb2.2_0 "qb2.2:  "
	qb3.2_0 "qb3.2:  "
	qb4.2_0 "qb4.2: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.2_1 "qb4.2: Sie ist klar und leicht verständlich"
	qb4.2_2 "qb4.2: Sie passt für eine Kreuzfahrt"
	qb4.2_3 "qb4.2: Sie ist für die Marke Costa Crociere passend"
	qb4.2_4 "qb4.2: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.2_5 "qb4.2: Es weckt mein Interesse, mehr zu erfahren"
	qb1.3_0 "qb1.3:  "
	qb2.3_0 "qb2.3:  "
	qb3.3_0 "qb3.3:  "
	qb4.3_0 "qb4.3: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.3_1 "qb4.3: Sie ist klar und leicht verständlich"
	qb4.3_2 "qb4.3: Sie passt für eine Kreuzfahrt"
	qb4.3_3 "qb4.3: Sie ist für die Marke Costa Crociere passend"
	qb4.3_4 "qb4.3: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.3_5 "qb4.3: Es weckt mein Interesse, mehr zu erfahren"
	qb1.4_0 "qb1.4:  "
	qb2.4_0 "qb2.4:  "
	qb3.4_0 "qb3.4:  "
	qb4.4_0 "qb4.4: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.4_1 "qb4.4: Sie ist klar und leicht verständlich"
	qb4.4_2 "qb4.4: Sie passt für eine Kreuzfahrt"
	qb4.4_3 "qb4.4: Sie ist für die Marke Costa Crociere passend"
	qb4.4_4 "qb4.4: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.4_5 "qb4.4: Es weckt mein Interesse, mehr zu erfahren"
	qb1.5_0 "qb1.5:  "
	qb2.5_0 "qb2.5:  "
	qb3.5_0 "qb3.5:  "
	qb4.5_0 "qb4.5: Sie ist eindeutig und originell im Vergleich zu anderen Kreuzfahrt-Beschreibungen "
	qb4.5_1 "qb4.5: Sie ist klar und leicht verständlich"
	qb4.5_2 "qb4.5: Sie passt für eine Kreuzfahrt"
	qb4.5_3 "qb4.5: Sie ist für die Marke Costa Crociere passend"
	qb4.5_4 "qb4.5: Es animiert mich dazu, sofort zu buchen, ohne Zeit zu verlieren"
	qb4.5_5 "qb4.5: Es weckt mein Interesse, mehr zu erfahren"
	r1_0 "r1: Selection #0"
	r1_1 "r1: Selection #1"
	r1_2 "r1: Selection #2"
	r1_3 "r1: Selection #3"
	r1_4 "r1: Selection #4"
	r1_5 "r1: Selection #5"
	r1a "r1a: Warum haben Sie sich für diese Beschreibung entschieden? Was hat Sie dabei insbesondere überzeugt? Bitte teilen Sie uns dies hier unten mit. Vielen Dank! "
	d1 "d1: Schließlich möchten wir, dass Sie uns einige Details geben.Wie viele Personen sind in Ihrer Familie? (Sie inbegriffen)"
	d2 "d2: Haben Sie Kinder unter 18 Jahren?"
	d2a "d2a: Wie viele Kinder unter 18 Jahren haben Sie?"
	d3 "d3: Welchen Bildungsabschluss haben Sie? "
	d4 "d4: Welchen Beruf über Sie zurzeit aus?"
.
VALUE LABELS
	s1
		1 "Mann"
		2 "Frau"
	/
	s2
		1 "Bremen"
		2 "Hamburg"
		3 "Niedersachsen"
		4 "Schleswig-Holstein"
		5 "Nordrhein-Westfalen"
		6 "Hessen"
		7 "Rheinland-Pfalz"
		8 "Saarland"
		9 "Baden-Württemberg"
		10 "Bayern"
		11 "Berlin"
		12 "Brandenburg"
		13 "Mecklenburg-Vorpommern"
		14 "Sachsen-Anhalt"
		15 "Sachsen"
		16 "Thüringen"
	/
	s2rec
		1 "Region (1) I"
		2 "Region (2) II"
		3 "Region (3) IIIa"
		4 "Region (4) IIIb"
		5 "Region (5) IV"
		6 "Region (6) V(a&b)+VI"
		7 "Region (7) VII"
	/
	s3rec
		1 "Meno di 20 anni"
		2 "20-50 anni"
		3 "51-75anni"
		4 "Più di 75 anni"
	/
	q1
		1 "Ja"
		2 "Nein"
	/
	q2
		1 "Ja"
		2 "Nein"
	/
	q3
		1 "Sehr interessiert "
		2 "Einigermaßen interessiert "
		3 "Weder noch"
		4 "Wenig interessiert"
		5 "Gar nicht interessiert"
	/
	q4_0 TO q4_6
		0 Not Mentioned
		1 Mentioned
	/
	s15_0 TO s15_1
		0 Not Mentioned
		1 Mentioned
	/
	s16_0 TO s16_5
		0 Not Mentioned
		1 Mentioned
	/
	s17_0 TO s17_3
		1 "1Gar nicht einverstanden"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Voll einverstanden"
	/
	s18
		1 "Mir gefällt es, immer wieder neue Orte zu erkunden "
		2 "Ich ziehe es vor, mich auf wenige Ziele zu konzentrieren und die lokale Kultur und Natur besser kennenzulernen "
		3 "Mir gefällt es, an einem Ort zu verweilen und mich zu entspannen"
	/
	s19
		1 "Alleine"
		2 "Mit meinem Partner/meiner Partnerin/meinem Mann/meiner Frau "
		3 "Mit meinem Partner/Partnerin und Kind(ern)"
		4 "Mit Kind(ern)"
		5 "Mit Freunden/Kollegen"
		6 "Andere Verwandte"
	/
	recDCG_0 TO recDCG_5
		0 Not Mentioned
		1 Mentioned
	/
	recIndici_0 TO recIndici_8
		0 Not Mentioned
		1 Mentioned
	/
	qb1.0_0 TO qb1.0_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.0_0 TO qb2.0_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.0_0 TO qb3.0_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.0_0 TO qb4.0_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	qb1.1_0 TO qb1.1_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.1_0 TO qb2.1_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.1_0 TO qb3.1_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.1_0 TO qb4.1_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	qb1.2_0 TO qb1.2_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.2_0 TO qb2.2_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.2_0 TO qb3.2_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.2_0 TO qb4.2_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	qb1.3_0 TO qb1.3_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.3_0 TO qb2.3_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.3_0 TO qb3.3_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.3_0 TO qb4.3_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	qb1.4_0 TO qb1.4_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.4_0 TO qb2.4_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.4_0 TO qb3.4_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.4_0 TO qb4.4_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	qb1.5_0 TO qb1.5_0
		1 "1Keine"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Sehr viel"
	/
	qb2.5_0 TO qb2.5_0
		1 "1Überhaupt nicht interessant"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst interessant"
	/
	qb3.5_0 TO qb3.5_0
		1 "1Überhaupt nicht authentisch"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst authentisch"
	/
	qb4.5_0 TO qb4.5_5
		1 "1Überhaupt nicht passend"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
		7 "7"
		8 "8"
		9 "9"
		10 "10Äußerst passend"
	/
	r1_0 TO r1_5
		1 "1"
		2 "2"
		3 "3"
		4 "4"
		5 "5"
		6 "6"
	/
	d1
		1 "1 Person"
		2 "2 Personen"
		3 "3 Personen"
		4 "4 Personen"
		5 "5 Personen"
		6 "6 Personen"
		7 "7 Personen"
		8 "8 Personen"
		9 "9+ Personen"
	/
	d2
		1 "Ja"
		2 "Nein"
	/
	d2a
		1 "1 "
		2 "2 "
		3 "3 "
		4 "4 "
		5 "5 "
		6 "6 "
		7 "7 oder mehr"
	/
	d3
		1 "Keinen/Volksschule"
		2 "Realschule"
		3 "Höhere Schule"
		4 "Hochschulabschluss"
		5 "Postgradualer Masterstudiengang/Doktorat"
	/
	d4
		1 "Leitender Angestellter/Freiberufler/Unternehmer"
		2 "Lehrer"
		3 "Angestellter/Beamter"
		4 "Arbeiter/Tagelöhner"
		5 "Vertreter/Händler/Geschäftsbetreiber"
		6 "Handwerker/selbstständiger Unternehmer"
		7 "Hausfrau"
		8 "Student/in"
		9 "Auf der Suche nach der ersten Anstellung/Arbeitslos"
		10 "Rentner/in"
	/
.
