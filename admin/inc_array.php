<?php
$array_decode = array('gender'=>'Sesso', 'birth_date'=>'Et&agrave;', 'mar_status_id'=>'Stato Civile', 'mobile_op'=>'Operatore Telefonico', 'work_id'=>'Occupazione', 'province_id'=>'Provincia', 'instr_level_id'=>'Istruzione', 'a_11'=>'Composizione famiglia', 'a_12'=>'Hobbies', 'a_13'=>'Prodotti tecnologici', 'a_14'=>'Mezzo di trasporto', 'a_21'=>'Prodotti alimentari', 'a_22'=>'Dove fa la spesa', 'a_23'=>'Abbonamenti TV', 'a_24'=>'Servizi/azioni internet', 'a_31'=>'Prodotti bancari o assicurativi', 'a_32'=>'Reddito familiare mensile', 'a_34'=>'Problemi di salute');

$array_tables = array('gender'=>'i.gender', 'birth_date'=>'i.birth_date', 'mar_status_id'=>'i.mar_status_id', 'mobile_op'=>'i.mobile_phone', 'work_id'=>'i.work_id', 'province_id'=>'i.province_id', 'instr_level_id'=>'i.instr_level_id', 'a_11'=>'p.question', 'a_12'=>'p.question', 'a_13'=>'p.question', 'a_14'=>'p.question', 'a_21'=>'p.question', 'a_22'=>'p.question', 'a_23'=>'p.question', 'a_24'=>'p.question', 'a_31'=>'p.question', 'a_32'=>'p.question', 'a_34'=>'p.question');

$gender = array(''=>'[Selezionare]','1'=>'Maschile','Femminile');

$instr_level_id = array(''=>'[Selezionare]', '1' => 'Nessuno', 'Licenza Elementare', 'Licenza Media Inferiore', 'Licenza Media Superiore', 'Diploma Universitario', 'Laurea', 'Specializzazione Post-laurea');

$mar_status_id = array(''=>'[Selezionare]', '1' => 'Celibe/Nubile', 'Sposato/a', 'Divorziato/a', 'Separato/a', 'Vedovo/a');

$mobile_op = array(''=>'[Selezionare]', 'TIM'=> 'TIM', 'H3G'=>'H3G', 'VOD'=>'Vodafone', 'WIN'=>'Wind');

$work_id = array(''=>'[Selezionare]', '1'=>'Agente di Commercio', 'Agricoltore', 'Analista/Programmatore', 'Architetto', 'Artigiano', 'Autotrasportatore/Autista', 'Avvocato', 'Bancario', 'Casalinga', 'Commercialista', 'Commerciante', 'Dirigente', 'Disoccupato', 'Farmacista', 'Fotografo', 'Geometra', 'Giornalista', 'Grafico', 'Impiegato', 'Imprenditore', 'Infermiere', 'Ingegnere', 'Insegnante/Docente', 'Medico', 'Militare/Forze dell\'Ordine', 'Musicista', 'Notaio', 'Operaio', 'Operatore Turistico', 'Pensionato', 'Psicologo', 'Pubblicitario', 'Ragioniere', 'Ricercatore', 'Studente', 'Altro');
 					
$province_id = array(''=>'[Selezionare]', '1'=>'Agrigento', 'Alessandria', 'Ancona', 'Aosta', 'Arezzo', 'Ascoli Piceno', 'Asti', 'Avellino', 'Bari', 'Belluno', 'Benevento', 'Bergamo', 'Biella', 'Bologna', 'Bolzano', 'Brescia', 'Brindisi', 'Cagliari', 'Caltanissetta', 'Campobasso', 'Caserta', 'Catania', 'Catanzaro', 'Chieti', 'Como', 'Cosenza', 'Cremona', 'Crotone', 'Cuneo', 'Enna', 'Ferrara', 'Firenze', 'Foggia', 'Forli\'', 'Frosinone', 'Genova', 'Gorizia', 'Grosseto', 'Imperia', 'Isernia', 'L\'Aquila', 'La Spezia', 'Latina', 'Lecce', 'Lecco', 'Livorno', 'Lodi', 'Lucca', 'Macerata', 'Mantova', 'Massa Carrara', 'Matera', 'Messina', 'Milano', 'Modena', 'Napoli', 'Novara', 'Nuoro', 'Oristano', 'Padova', 'Palermo', 'Parma', 'Pavia', 'Perugia', 'Pesaro e Urbino', 'Pescara', 'Piacenza', 'Pisa', 'Pistoia', 'Pordenone', 'Potenza', 'Prato', 'Ragusa', 'Ravenna', 'Reggio Calabria', 'Reggio Emilia', 'Rieti', 'Rimini', 'Roma', 'Rovigo', 'Salerno', 'Sassari', 'Savona', 'Siena', 'Siracusa', 'Sondrio', 'Taranto', 'Teramo', 'Terni', 'Torino', 'Trapani', 'Trento', 'Treviso', 'Trieste', 'Udine', 'Varese', 'Venezia', 'Verbano-Cusio-Os', 'Vercelli', 'Verona', 'Vibo Valentia', 'Vicenza', 'Viterbo', 'Altro', 'Fermo', 'Barletta Andria Trani');

$q_11_original = 'Composizione della famiglia (escludendo te stesso)';
$q_11 = 'Composizione famiglia';
$a_11 = array('0'=>'Bambini/Ragazzi 12-18 anni','1'=>'Bambini 4-11 anni','Bambini <3 anni','Nessun figlio/nessun figlio al di sotto dei 18 anni');

$q_12_original = 'Quali sono i tuoi hobbies?';
$q_12 = 'Hobbies';
$a_12 = array('0'=>'Musica','Giardinaggio','Fai da te','Lettura','Giochi','Cucina','Arte','Cinema','Fotografia','Danza','Sport','Altro','Nessuno');

$q_13_original = 'Quali dei seguenti prodotti tecnologici sono presenti in casa tua?';
$q_13 = 'Prodotti tecnologici';
$a_13 = array('0'=>'Tv Led','Tv Plasma','Tv LCD','Tv normale','decoder per digitale terrestre','decoder e parabola per Tv satellitare','decoder per Tv via Web','Macchina per il caff&#232;','Forno a microonde','Congelatore','Macchina fotografica compatta','Macchina fotografica reflex','Videocamera','I-pod','I-phone','Smartphone (qualsiasi marca)','Telefono cellulare no smartphone','i-pad','Pad (qualsiasi marca)','Playstation','Wii','X-Box','Nintendo DS (qualsiasi versione)','Stereo musica','Blue ray','Lettore CD/DVD','Laptop o Notebook','PC desktop','e-book reader','i-pod station','Lampade solari','Pannelli fotovoltaici per la produzione di elettricit&#224;','Impianto solare per l&#180;acqua calda','Pala eolica');

$q_14_original = 'Possiedi un mezzo di trasporto? Se si, quale marca e che categoria?';
$q_14 = 'Mezzo di trasporto';
$a_14 = array('0'=>'Si, l&#180;auto','Si la moto','No, mi muovo prevalentemente con i mezzi pubblici','No mi muovo prevalentemente a piedi o con la bicicletta');
$a_14_0_brand = array('0'=>'Alfa', 'Romeo', 'Aston', 'Martin', 'Audi', 'Bentley', 'Bmw', 'Bugatti', 'Buick', 'Cadillac', 'Chevrolet', 'Chrysler', 'Citroen', 'Daewoo', 'Dodge', 'Daihatsu', 'Ferrari', 'Fiat', 'Ford', 'GMC', 'Honda', 'Hummer', 'Hyundai', 'Infiniti', 'Isuzu', 'Jaguar', 'Jeep', 'Kia', 'Lamborghini', 'Lancia', 'Land', 'Rover', 'Lexus', 'Lincoln', 'Lotus', 'Maserati', 'Maybach', 'Mazda', 'Mercedes', 'Mercury', 'Mini', 'Mitsubishi', 'Morgan', 'Nissan', 'Opel', 'Peugeot', 'Pontiac', 'Porsche', 'Renault', 'Rolls', 'Royce', 'Saab', 'Saturn', 'Scion', 'Seat', 'Saleen', 'Skoda', 'Smart', 'Spyker', 'Ssangyong', 'Subaru', 'Suzuki', 'Tata', 'Toyota', 'Volkswagen', 'Volvo');
$a_14_0_model = array('0'=>'Berlina', 'Cabrio e spider', 'City car/utilitaria', 'Microcar (senza patente)', 'Coup&eacute;', 'Fuoristrada e Suv', 'Monovolume', 'Pick-up', 'Roadster', 'Station Wagon');
$a_14_1_brand = array('0'=>'Adly', 'Aeon', 'AJS', 'Aprilia', 'Arctic', 'Cat', 'ATK', 'Atlas', 'Honda', 'Bajaj', 'Benelli', 'Beta', 'Bimota', 'Blata', 'BMW', 'Buell', 'Cagiva', 'DB, Motors', 'Derbi', 'Dnepr', 'Ducati', 'Royal, Enfield', 'Garelli', 'GAS GAS', 'Gilera', 'Harley-Davidson', 'Husaberg', 'Husqvarna', 'Hyosung', 'Italjet', 'Jawa', 'Kawasaki', 'KTM', 'Kymco', 'Lambretta', 'Laverda', 'Lem', 'Malaguti', 'MBK', 'Moto Guzzi', 'Moto Morini', 'MV Agusta', 'MZ', 'Norton', 'Peugeot', 'PGO', 'Piaggio', 'Polini', 'Suzuki', 'Sym', 'Triumph', 'Ural', 'Vespa', 'Yamaha');
$a_14_1_model = array('0'=>'Super Sport', 'Sport Touring', 'Touring', 'Custom/cruiser', 'Enduro/offroad', 'Cross', 'Super Motard', 'Naked', 'Motociclette d\'epoca', 'Scooter', 'Scooter/Moto elettrica', 'Allround', 'Minimoto', 'Prototipo/concept');

$q_21_original = 'Quali dei seguenti prodotti alimentari consumi almeno una volta al mese?';
$q_21 = 'Prodotti alimentari';
$a_21 = array('0'=>'Prodotti di marche famose','Prodotti con il marchio del supermercato/ipermercato (marche private)','Prodotti di marche non conosciute ma convenienti (prodotti di primo prezzo)','Prodotti da agricoltura biologica','Prodotti del commercio solidale','Prodotti della cucina etnica di paesi stranieri (cinesi, messicani, indiani, ...)','Acquisto prodotti a km 0 (impatto zero sull&#180;ambiente)','Nessuno');

$q_22_original = 'Dove ti capita di fare la spesa qualche volta?';
$q_22 = 'Dove fa la spesa';
$a_22 = array('0'=>'Supermercato','Ipermercato/centro commerciale','Discount','Supermercati di prodotti biologici e naturali','Mercato rionale','Negozio al dettaglio tradizionale','Direttamente dal produttore locale','Tramite gruppi d&#180;acquisto','Acquisti online','Nessuno');

$q_23_original = 'Parliamo adesso della Tv? A quali dei seguenti servizi sei abbonato?';
$q_23 = 'Abbonamenti TV';
$a_23 = array('0'=>'Abbonamento Tv Rai','abbonamento Mediaset','abbonamento Sky','abbonamento Web Tv Fastweb','abbonamento Web-Tv Telecom (Cubovision)','altri abbonamenti','Nessuno');

$q_24_original = 'Infine parliamo dell&#180;uso di Internet, quale dei seguenti servizi/azioni svolgi normalmente su Internet?';
$q_24 = 'Servizi/azioni internet';
$a_24 = array('0'=>'Acquisto biglietti aerei','acquisto biglietti treni','acquisto per i viaggio in genere (hotel, appartamenti, noleggi, ecc.)','acquisto biglietti per spettacoli (teatro, cinema, sport, concerti, ecc.)','home banking solo informativo,','home banking informativo e dispositivo','lettura news','lettura sport','ricerca immagini','ricerca video','facebook','twitter','skype','chat (in genere)','download musica','download video/film','streaming','acquisto prodotti informatici','acquisto libri','acquisto vestiario','acquisto tramite e-bay');

$q_31_original = 'Quale dei seguenti prodotti bancari o assicurativi sono in tuo possesso?';
$q_31 = 'Prodotti bancari o assicurativi';
$a_31 = array('0'=>'Conto corrente online','Conto online trading','Conto corrente tradizionale','Assicurazione auto o moto fatta online','assicurazione auto moto tradizionale','assicurazione sanitaria','assicurazione infortuni','assicurazione sulla casa','mutuo casa, presito personale','Nessuno');

$q_32_original = 'Mi potrebbe dire all&#180;incirca qual &#232; il reddito complessivo netto della sua famiglia<br /> in un mese?';
$q_32 = 'Reddito familiare mensile';
$a_32 = array('0'=>'Fino a 1.500&euro;','1.500-2.000&euro;','2.000&euro;-3000&euro;','3.000&euro;-4.000&euro;','4.000&euro;-5.000&euro;','Pi&#249; di 5.000&euro;','Preferisco non rispondere');

$q_33_original = 'Le faremo ora una domanda relativa alla sua salute.
Attenzione: per rispondere a <br />questa domanda deve necessariamente ed esplicitamente dare il consenso<br /> secondo la normativa sulla privacy.
Vuole rispondere alla domanda?';
$q_33 = 'Consenso per domanda sulla salute';
$a_33 = array('0'=>'Si, i dati rilasciati verranno trattati secondo la normativa196/2003 e regolati dalle norme di comportamento Assirm ed Esomar per le ricerche scientifiche e regolati dalla normativa sui dati sensibili.','No, preferisco non rispondere a questa domanda.');

$q_34_original = 'Da quali dei seguenti problemi di salute sei afflitto personalmente?';
$q_34 = 'Problemi di salute';
$a_34 = array('0'=>'Mal di testa/emicranie','Colesterolo/Trigliceridi alti','Stitichezza/intestino pigro','Difficolt&#224; a dormire/Insonnia','Dolori muscolari/articolari','Stress/stanchezza','Emorroidi','Sovrappeso','Problemi circolatori','Problemi cardiologici','Problemi ricorrenti alle vie respiratorie','Problemi urologici/alle vie urinarie','Caduta di capelli Dermatiti/psoriasi/problemi alla pelle','Frequenti mal di gola/stati influenzali','Herpes','Allergie','Intolleranze alimentari','Sinusite e naso chiuso','Problemi dentali e della bocca','Ansia/Depressione/problemi mentali/psicologici Problemi digestivi/intestinali (reflusso, bruciori, ulcere, colon irritabile, gonfiori, meteorismo, ecc.)','Problemi di fegato','Problemi endocrinologici o di disfunzioni del metabolismo','Tumori/neoplasie','Problemi neurologici','Problemi sessuali/riproduttivi','Problemi alle orecchie(otiti, labirintiti, ecc.)','Sordit&#224;','Altro','Nessuno di questi');

?>