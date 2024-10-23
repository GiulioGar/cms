<?php

// Funzione per gestire la connessione al database
function getConnection($admin, $database_admin) {
    mysqli_select_db($admin, $database_admin);
}

// Funzione per eseguire una query e restituire un singolo risultato
function fetchSingleResult($admin, $query) {
    $result = mysqli_query($admin, $query);
    return mysqli_fetch_assoc($result);
}

// Funzione per eseguire una query e restituire tutti i risultati
function fetchAllResults($admin, $query) {
    $result = mysqli_query($admin, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Funzione per ottenere i dati di ricerche esterne
function getResearchData($admin, $country, $year) {
    $queries = [
        'total' => "SELECT COUNT(sur_id) as total FROM t_panel_control 
                    WHERE paese='$country' AND complete_ext>0 AND sur_date LIKE '$year%' AND (panel=0 OR panel=1)",
        'complete_ext' => "SELECT SUM(complete_ext) as complete_ext FROM t_panel_control 
                           WHERE paese='$country' AND complete_ext>0 AND sur_date LIKE '$year%' AND (panel=0 OR panel=1)"
    ];
    
    return [
        'total' => fetchSingleResult($admin, $queries['total']),
        'complete_ext' => fetchSingleResult($admin, $queries['complete_ext'])['complete_ext'] ?? 0
    ];
}

// Funzione per calcolare la media di redemption
function calculateRedemption($admin, $year) {
    $query_conta = "SELECT COUNT(sur_id) as tot FROM t_panel_control 
                    WHERE panel=1 AND stato=1 AND sur_date LIKE '$year%'";
    $surClo = fetchSingleResult($admin, $query_conta);

    $query_ric = "SELECT red_panel FROM t_panel_control 
                  WHERE panel=1 AND stato=1 AND sur_date LIKE '$year%'";
    $tot_close = fetchAllResults($admin, $query_ric);

    $totRed = array_sum(array_column($tot_close, 'red_panel'));
    return $surClo['tot'] > 0 ? $totRed / $surClo['tot'] : 0;
}

// Funzione per ottenere i dati dei clienti
function getClientData($admin, $actualYear, $pastYears) {
    $query_clienti = "SELECT cliente, 
                        SUM(IF(sur_date LIKE '%$actualYear%', 1, 0)) AS conta2020,
                        SUM(IF(sur_date LIKE '%{$pastYears[0]}%', 1, 0)) AS conta2019,
                        SUM(IF(sur_date LIKE '%{$pastYears[1]}%', 1, 0)) AS conta2018
                      FROM t_panel_control
                      WHERE cliente<>''
                      GROUP BY cliente
                      ORDER BY cliente ASC";
    return fetchAllResults($admin, $query_clienti);
}

// Definizione delle date e degli anni
$today = date("Y-m-d H:i:s", mktime(date("H") - 6));
$mesi1 = date("Y-m-d H:i:s", mktime(date("H") - 6, 0, 0, date("m") - 1));
$mesi2 = date("Y-m-d H:i:s", mktime(date("H") - 6, 0, 0, date("m") - 2));
$mesi4 = date("Y-m-d H:i:s", mktime(date("H") - 6, 0, 0, date("m") - 4));
$mesi6 = date("Y-m-d H:i:s", mktime(date("H") - 6, 0, 0, date("m") - 6));
$mesi12 = date("Y-m-d H:i:s", mktime(date("H") - 6, 0, 0, date("m"), date("d"), date("Y") - 1));

$actualYear = date("Y");
$pastYears = range($actualYear - 4, $actualYear);

// Stabilire la connessione una sola volta
getConnection($admin, $database_admin);

// Totale utenti
$tot_use = fetchSingleResult($admin, "SELECT COUNT(*) as total FROM t_user_info WHERE active='1'");
$tot_useGirl = fetchSingleResult($admin, "SELECT COUNT(*) as total FROM t_user_info WHERE active='1' AND gender='2'");
$tot_useMen = fetchSingleResult($admin, "SELECT COUNT(*) as total FROM t_user_info WHERE active='1' AND gender='1'");


// Utenti attivi per anno
$query_attivi = "SELECT COUNT(DISTINCT story.user_id) as total, YEAR(event_date) AS anno 
                 FROM millebytesdb.t_user_history AS story 
                 WHERE story.event_type NOT IN ('subscribe', 'unsubscribe') 
                 AND YEAR(event_date) BETWEEN " . ($actualYear - 4) . " AND $actualYear 
                 GROUP BY anno";

			 
$tot_attivi = fetchAllResults($admin, $query_attivi);
$activeUsers = [];
foreach ($pastYears as $year) {
    $activeUsers[$year] = 0; // Imposta il valore a 0 di default per ciascun anno
}

// Assegna i valori reali dai risultati della query
foreach ($tot_attivi as $row) {
    $activeUsers[$row['anno']] = $row['total'];
}

// I dati finali per Chart.js
$activeUsersData = array_values($activeUsers); // Solo i valori (numero utenti attivi)

// Esempio: Ricerche esterne Italia 2020
$italia_2020 = getResearchData($admin, 'Italia', $actualYear);
$uk_2020 = getResearchData($admin, 'Uk', $actualYear);
$francia_2020 = getResearchData($admin, 'Francia', $actualYear);

// Esempio: Calcolo redemption 2020
$medRed20 = calculateRedemption($admin, $actualYear);
$medRed19 = calculateRedemption($admin, $pastYears[0]);
$medRed18 = calculateRedemption($admin, $pastYears[1]);
$medRed17 = calculateRedemption($admin, $pastYears[2]);
$medRed16 = calculateRedemption($admin, $pastYears[3]);

// Dati clienti
$clientData = getClientData($admin, $actualYear, $pastYears);
$numClient = count($clientData);

// Dati di registrazione utenti per anno
$totReg20 = fetchSingleResult($admin, "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info WHERE reg_date LIKE '$actualYear%' AND active=1");
$totReg19 = fetchSingleResult($admin, "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info WHERE reg_date LIKE '{$pastYears[0]}%' AND active=1");
$totReg18 = fetchSingleResult($admin, "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info WHERE reg_date LIKE '{$pastYears[1]}%' AND active=1");
$totReg17 = fetchSingleResult($admin, "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info WHERE reg_date LIKE '{$pastYears[2]}%' AND active=1");
$totReg16 = fetchSingleResult($admin, "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info WHERE reg_date LIKE '{$pastYears[3]}%' AND active=1");

// Complete Italia 2018-2020
function getCompleteData($admin, $country, $year) {
    $query = "SELECT complete_int, complete_ext FROM t_panel_control 
              WHERE sur_date LIKE '$year%' AND paese='$country' AND (panel=0 OR panel=1)";
    $results = fetchAllResults($admin, $query);
    
    $total_int = 0;
    $total_ext = 0;
    
    foreach ($results as $row) {
        $total_int += $row['complete_int'];
        $total_ext += $row['complete_ext'];
    }
    
    $total = $total_int + $total_ext;
    
    return [
        'interne' => $total_int,
        'esterne' => $total_ext,
        'percentuale_interne' => $total > 0 ? number_format(($total_int / $total) * 100, 2) : 0,
        'percentuale_esterne' => $total > 0 ? number_format(($total_ext / $total) * 100, 2) : 0
    ];
}

$italia_2018 = getCompleteData($admin, 'Italia', '2018');
$italia_2019 = getCompleteData($admin, 'Italia', '2019');
$italia_2020 = getCompleteData($admin, 'Italia', $actualYear);

// Inizializzazione delle variabili per le fasce di età
$t17_use = 0;
$t18_use = 0;
$t25_use = 0;
$t35_use = 0;
$t45_use = 0;
$t55_use = 0;
$t65_use = 0;

// Query ottimizzata per recuperare gli utenti per fasce di età
$query_age_groups = "
SELECT 
  CASE 
    WHEN YEAR(CURDATE()) - YEAR(birth_date) < 18 THEN 'Under 18'
    WHEN YEAR(CURDATE()) - YEAR(birth_date) BETWEEN 18 AND 24 THEN '18-24'
    WHEN YEAR(CURDATE()) - YEAR(birth_date) BETWEEN 25 AND 34 THEN '25-34'
    WHEN YEAR(CURDATE()) - YEAR(birth_date) BETWEEN 35 AND 44 THEN '35-44'
    WHEN YEAR(CURDATE()) - YEAR(birth_date) BETWEEN 45 AND 54 THEN '45-54'
    WHEN YEAR(CURDATE()) - YEAR(birth_date) BETWEEN 55 AND 64 THEN '55-64'
    ELSE '65+'
  END AS age_group,
  COUNT(*) AS total
FROM t_user_info
WHERE active = 1
GROUP BY age_group";

// Esegui la query per recuperare i dati per le fasce di età
$age_groups_result = mysqli_query($admin, $query_age_groups);

// Inizializza array per le fasce di età
$age_groups = [
    'Under 18' => 0,
    '18-24' => 0,
    '25-34' => 0,
    '35-44' => 0,
    '45-54' => 0,
    '55-64' => 0,
    '65+' => 0,
];

// Popola i dati delle fasce di età con i risultati della query
while ($row = mysqli_fetch_assoc($age_groups_result)) {
    $age_groups[$row['age_group']] = $row['total'];
}

// Assegna i risultati alle variabili da usare nel grafico
$t17_use = $age_groups['Under 18'];
$t18_use = $age_groups['18-24'];
$t25_use = $age_groups['25-34'];
$t35_use = $age_groups['35-44'];
$t45_use = $age_groups['45-54'];
$t55_use = $age_groups['55-64'];
$t65_use = $age_groups['65+'];



?>
