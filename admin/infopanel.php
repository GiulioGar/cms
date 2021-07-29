
<style>

.table-scroll tbody {
    position: absolute;
    overflow-y: scroll;
    height: 750px;
}

.table-scroll tr {
    width: 60%;
    table-layout: fixed;
    display: inline-table;
}

.table-scroll thead > tr > th {
    border: none;
}

    
</style>

<?php
$query_surv = "SELECT province_id, COUNT(*) as count 
FROM t_user_info
where active=1
GROUP BY province_id 
ORDER BY province_id ASC";
$csv_sur = mysqli_query($admin,$query_surv) ;	



$arrayProv = array(
array("null","Alessandria", "Crotone", "Aosta", "Arezzo", "Ascoli", "Piceno", "Asti", "Avellino", "Bari", "Belluno", "Benevento", "Bergamo", "Biella", "Bologna", "Bolzano", "Brescia", "Brindisi", "Cagliari", "Caltanissetta", "Campobasso", "Caserta", "Catania", "Catanzaro", "Chieti", "Como", "Cosenza", "Cremona","Nulla", "Cuneo", "Enna", "Ferrara", "Firenze", "Foggia", "Forli'", "Frosinone", "Genova", "Gorizia", "Grosseto", "Imperia Isernia", "L'Aquila", "La Spezia", "Latina", "Lecce", "Lecco", "Livorno", "Lodi", "Lucca", "Macerata", "Mantova", "Massa Carrara", "Matera", "Messina", "Milano", "Modena", "Napoli", "Novara", "Nuoro", "Oristano", "Padova", "Palermo", "Parma", "Pavia", "Perugia", "Pesaro e Urbino", "Pescara", "Piacenza", "Pisa", "Pistoia", "Pordenone", "Potenza", "Prato", "Ragusa", "Ravenna", "Reggio", "Calabria", "Reggio Emilia", "Rieti", "Rimini", "Roma", "Rovigo", "Salerno", "Sassari", "Savona", "Siena", "Siracusa", "Sondrio", "Taranto", "Teramo", "Terni", "Torino", "Trapani", "Trento", "Treviso", "Trieste", "Udine", "Varese", "Venezia", "Verbano-Cusio-Os", "Vercelli", "Verona", "Vibo Valentia", "Vicenza", "Viterbo", "Altro", "Fermo", "Barletta Andria Trani"),
array("null","426658", "175566", "126883", "344374", "105000", "105000", "216677", "423506", "1260142", "205781", "279675", "1109933", "178551", "1009210", "524256", "1262318", "397083", "560373", "269710", "224644", "924166", "1113303", "362343", "389169", "600190", "711739", "359388", "589108", "168052", "348362", "1014423", "628556", "394067", "493067", "850071", "139673", "223045", "215130", "301910", "220698", "574891", "802082", "339238", "337334", "229338", "390042", "318921", "412610", "196580", "199685", "636653", "3218201", "700862", "3107006", "370143", "156096", "160746", "936274", "1268217", "448899", "547251", "660690", "360711", "321309", "286758", "421851", "291839", "312051", "370680", "254608", "321359", "391414", "553861", "553861", "532483", "157420", "336786", "4353738", "238588", "1104731", "333116", "279408", "268341", "402822", "181437", "583479", "309859", "228218", "2277857", "434476", "538604", "885972", "234682", "531466", "890043", "854275", "159664", "173868", "921557", "161619", "865082", "319008", "319000", "174849", "392546")
);
?>


                            <table class="table table-scroll table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-xs-4">Provincia</th>
                                        <th class="col-xs-4">Utenti</th>
                                        <th class="col-xs-4">Abitanti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    while ($row = mysqli_fetch_assoc($csv_sur))
                                    {
                                       if($row["province_id"] != 28) 
                                       {
                                     echo"<tr>
                                     <td class='col-xs-6'> ".$arrayProv[0][$row['province_id']]." </td>
                                   
                                    <td class='col-xs-6'>".$row['count']."</td>

                                    <td class='col-xs-6'>".$arrayProv[1][$row['province_id']]."</td>
                                    </tr>"; 
                                }
                            }    
                                ?>

                                </tbody>
                            </table>


