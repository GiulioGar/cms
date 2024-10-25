<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    require_once('inc_taghead.php'); 
    mysqli_select_db($admin,$database_admin);	

    // Recupero delle variabili tramite $_GET
    $id_sur = $_GET['id_sur'] ?? null;
    $closearch = $_GET['closearch'] ?? null;
    $openSearch = $_GET['openSearch'] ?? null;
    $modSearch = $_GET['modSearch'] ?? null;
    $sid = $_GET['sid'] ?? null;
    $prj = $_GET['prj'] ?? null;
    $panel = $_GET['panel'] ?? null;
    $loi = $_GET['loi'] ?? null;
    $argomento = $_GET['argomento'] ?? null;
    $points = $_GET['point'] ?? null;
    $sex_target = $_GET['sex_target'] ?? null;
    $age1_target = $_GET['age1_target'] ?? null;
    $age2_target = $_GET['age2_target'] ?? null;
    $descrizione = $_GET['descrizione'] ?? null;
    $end_date = $_GET['end_date'] ?? null;
    $labprj = $_GET['labprj'] ?? null;
    $goal = $_GET['goal'] ?? null;
    $paese = $_GET['paese'] ?? null;
    $cliente = $_GET['cliente'] ?? null;
    $tipologia = $_GET['tipologia'] ?? null;
    $costoSur = $_GET['costoSur'] ?? null;

    $cerca_progetto = $_GET['prj'] ?? '%';
    $cerca_panel = $_GET['Cpanel'] ?? '%';
    $cerca_anno = ($_GET['Canno'] ?? '%') . '%';

    $data = date("Y-m-d");

    // Gestione dell'aggiunta di una nuova ricerca
    if ($openSearch == "Aggiungi") {
        $query_surv = "SELECT sur_id FROM t_panel_control";
        $controlSur = mysqli_query($admin, $query_surv);
        $duplicate = 0;

        while ($row = mysqli_fetch_assoc($controlSur)) {
            if ($row['sur_id'] == $sid) {
                $duplicate++;
            }
        }

        if ($duplicate > 0) {
            echo "<div title='Attenzione!' class='dialog-message'>Attenzione, questa ricerca è già stata inserita!</div>";
        } else {
            // Inserimento sicuro dei dati
            $query_user = $admin->prepare(
                "INSERT INTO t_panel_control 
                (sur_id, prj, end_field, stato, sex_target, age1_target, age2_target, end_field, description, goal, panel, paese, cliente, tipologia, bytes) 
                VALUES (?, ?, ?, '0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $query_user->bind_param(
                "ssssssssssssss", $sid, $prj, $data, $sex_target, $age1_target, $age2_target, $end_date, 
                $descrizione, $goal, $panel, $paese, $cliente, $tipologia, $points
            );
            $query_user->execute();

            if ($panel == 1) {
                $query_loi = "INSERT INTO t_surveys_env (prj_name, sid, name, value, store) 
                VALUES ('$prj', '$sid', 'length_of_interview', '$loi', '0')";
                mysqli_query($admin, $query_loi);

                $query_argomento = "INSERT INTO t_surveys_env (prj_name, sid, name, value, store) 
                VALUES ('$prj', '$sid', 'survey_object', '$argomento', '0')";
                mysqli_query($admin, $query_argomento);

                $query_punti = "INSERT INTO t_surveys_env (prj_name, sid, name, value, store) 
                VALUES ('$prj', '$sid', 'prize_complete', '$points', '0')";
                mysqli_query($admin, $query_punti);
            }
        }
    }

    // Gestione della modifica di una ricerca esistente
    if ($modSearch == "Modifica") {
        $query_user = "UPDATE t_panel_control 
            SET panel='$panel', age1_target='$age1_target', age2_target='$age2_target', prj='$labprj', end_field='$end_date',
            description='$descrizione', goal='$goal', sex_target='$sex_target', paese='$paese'
            WHERE sur_id='$id_sur'";
        mysqli_query($admin, $query_user);
    }

    // Gestione apertura/chiusura delle ricerche
    if ($closearch == "CLOSE" || $closearch == "OPEN") {
        $statoSur = ($closearch == "CLOSE") ? 0 : 1;
        $query_aggiorna = "UPDATE t_panel_control SET stato=$statoSur, costo=$costoSur WHERE id='$id_sur'";
        mysqli_query($admin, $query_aggiorna);
    }

    // Aggiornamento dei giorni rimanenti
    $query_ricerche = "SELECT * FROM t_panel_control ORDER BY stato ASC, giorni_rimanenti ASC, id DESC";
    $tot_ricerche = mysqli_query($admin, $query_ricerche);

    require_once('inc_taghead.php');
    require_once('inc_tagbody.php');
?>


<style>
    /* Riduzione delle dimensioni del testo per la tabella */
    #table_sur {
        font-size: 0.75rem;  /* Imposta una dimensione del testo più piccola */
    }

    thead { font-size: 0.77rem; }

    /* Rimpicciolisce il testo nelle celle della tabella */
    #table_sur td {
text-align: center;
    }




    .sorting_disabled:nth-child(2) { min-width: 30%; }

    .sorting_disabled { text-align: center; }

    /* Personalizza lo sfondo e il testo del tooltip */
    .tooltip-inner {
        background-color: #333;         /* Sfondo scuro */
        color: #fff;                    /* Testo bianco */
        font-size: 14px;                /* Dimensione del testo */
        max-width: 250px;               /* Larghezza massima del tooltip */
        padding: 10px 15px;             /* Maggiore padding per leggibilità */
        border-radius: 8px;             /* Bordi arrotondati */
        text-align: center;             /* Testo centrato */
    }

    /* Personalizza la freccia del tooltip */
    .bs-tooltip-top .arrow::before, 
    .bs-tooltip-bottom .arrow::before, 
    .bs-tooltip-left .arrow::before, 
    .bs-tooltip-right .arrow::before {
        border-color: #333 !important;  /* Colore della freccia */
    }

    /* Aggiunge ombreggiatura per un effetto elevato */
    .tooltip.bs-tooltip-top .arrow::before,
    .tooltip.bs-tooltip-bottom .arrow::before,
    .tooltip.bs-tooltip-left .arrow::before,
    .tooltip.bs-tooltip-right .arrow::before {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    /* Animazione del tooltip */
    .tooltip.show {
        opacity: 0.95;                  /* Leggera trasparenza */
        transition: opacity 0.3s ease-in-out;
    }

</style>


<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col col-xs-6">
            </div>
            <div class="col col-xs-6 text-right">
                <?php require_once('modulo_aggiungi_ricerca.php'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id='table_sur' class='display'>
                                <thead>
                                    <tr>
                                        <th>Ricerca</th>
                                        <th>Descrizione</th>
                                        <th>Panel</th>
                                        <th>Complete</th>
                                        <th><i class="fa-solid fa-percent"></i></th>
                                        <th><i class="fa-solid fa-percent"></i></th>
                                        <th><i class="fa-solid fa-flag-checkered"></i></th>
                                        <th><i class="fa-regular fa-calendar-days"></i></th>
                                        <th><i class="fa-solid fa-money-bill-wave"></i></th>
                                        <th><i class="fa-solid fa-award"></i></th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$query_aggiorna_statistiche = "UPDATE t_panel_control set giorni_rimanenti='".$daysField."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche);
 ?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifica Dati Ricerca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <!-- Campo nascosto per ID ricerca -->
                    <input type="hidden" id="edit_id" name="sur_id">

                    <!-- Descrizione -->
                    <div class="form-group">
                        <label for="edit_description">Descrizione</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>

                    <!-- Panel -->
                    <div class="form-group">
                        <label for="edit_panel">Panel</label>
                        <select class="form-control" id="edit_panel" name="panel" required>
                            <option value="1">Millebytes</option>
                            <option value="0">Esterno</option>
                            <option value="2">Target</option>
                        </select>
                    </div>

                    <!-- Genere (Sex Target) -->
                    <div class="form-group">
                        <label for="edit_sex_target">Genere</label>
                        <select class="form-control" id="edit_sex_target" name="sex_target" required>
                            <option value="1">Uomo</option>
                            <option value="2">Donna</option>
                            <option value="3">Uomo/Donna</option>
                        </select>
                    </div>

                    <!-- Età Minima e Massima -->
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="edit_age1_target">Età Minima</label>
                            <input type="number" class="form-control" id="edit_age1_target" name="age1_target" required>
                        </div>
                        <div class="form-group col">
                            <label for="edit_age2_target">Età Massima</label>
                            <input type="number" class="form-control" id="edit_age2_target" name="age2_target" required>
                        </div>
                    </div>

                    <!-- Interviste (Goal) -->
                    <div class="form-group">
                        <label for="edit_goal">Interviste</label>
                        <input type="number" class="form-control" id="edit_goal" name="goal" required>
                    </div>

                    <!-- Data di Chiusura (End Date) -->
                    <div class="form-group">
                        <label for="edit_end_date">Chiusura Field</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                    </div>

                    <!-- Stato della Ricerca -->
                    <div class="form-group">
                        <label for="edit_status">Stato</label>
                        <select class="form-control" id="edit_status" name="stato" required>
                            <option value="0">Aperto</option>
                            <option value="1">Chiuso</option>
                        </select>
                    </div>

                    <!-- Bottone per Salva Modifiche -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php require_once('inc_footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>

<script>
$(document).ready(function() {
  $.fn.dataTable.moment('YYYY-MM-DD'); 
  console.log("Plugin datetime-moment caricato correttamente");
  
    $('#table_sur').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "func_pannello.php",  // Assicurati che il percorso sia corretto
        "autoWidth": false,  // Forza il ridimensionamento automatico delle colonne
        "ordering": false,  // Disabilita l'ordinamento per tutte le colonne
        "columns": [
            { 
            "data": "sur_id",
            "render": function(data, type, row) {
                // Crea il link usando sur_id e prj
                return `<a href="controlloField.php?prj=${row.prj}&sid=${data}" target="_blank">${data}</a>`;
            }
        },
            { 
            "data": "description",
            "render": function(data, type, row) {
                const truncatedText = data.length > 30 ? data.substr(0, 30) + '...' : data;
                return `<span data-toggle="tooltip" title="${data}">${truncatedText}</span>`;
            }
        },
        { 
            "data": "panel",
            "render": function(data, type, row) {
                // Usa icone per i valori Interno ed Esterno
                if (data == "Interno") {
                    return '<i style="color:#9DCE6B" class="fas fa-home" title="Interno"></i>';
                } else if (data == "Esterno") {
                    return '<i style="color:red" class="fa-solid fa-person-walking-arrow-right"></i>';
                }
                return data;  // Per altri valori
            }
        },           // Panel
            { "data": "complete" },        // Complete
            { "data": "red_panel" },       // % Panel
            { "data": "red_surv" },        // % Ricerca
            { 
                "data": "end_field",
                "render": function(data) {
                    return moment(data).format('YYYY-MM-DD');  // Forza il formato data per coerenza
                }
            },
            { "data": "giorni_rimanenti" },// Giorni rimanenti
            { "data": "costo" },           // Costo Panel
            { "data": "bytes" },           // Bytes
            { "data": "stato",
              "render": function(data, type, row) {
                // Usa icone per i valori Interno ed Esterno
                if (data == "Aperto") {
                    return '<i style="color:#9DCE6B" class="fa-solid fa-lock-open" title="Interno"></i>';
                } else if (data == "Chiuso") {
                    return '<i style="color:red" class="fa-solid fa-lock"></i>';
                }
                return data;  // Per altri valori
            }
             },    
                    
             { 
                "data": null,
                "render": function(data, type, row) {
                    return `<i class="fas fa-edit edit-button" data-id="${row.sur_id}" data-toggle="modal" data-target="#editModal" 
                                style="cursor: pointer; color: #007bff; font-size: 1.2em;" title="Modifica">
                            </i>`;
                },

                "orderable": false
            }


        ],
        "columnDefs": [

    ],
        "order": [[10, "asc"], [6, "desc"]],  
        "pagingType": "full_numbers",
        "scrollY": true,  // Rimuove lo scorrimento verticale
        "scrollX": false,  // Rimuove lo scorrimento orizzontale
        "language": {
            "emptyTable": "Non sono presenti dati",
            "search": "Cerca:",
            "lengthMenu": "Mostra _MENU_ ricerche"
        },
        "lengthMenu": [[10, 60, 100, -1], [10, 30, 100, "All"]],
        "pageLength": 30,
"initComplete": function(settings, json) {
            console.log("Dati ricevuti:", json);
            $('[data-toggle="tooltip"]').tooltip();  // Inizializza i tooltip al completamento iniziale
        },
        "drawCallback": function() {
            // Reinizializza i tooltip ogni volta che la tabella viene ridisegnata
            $('[data-toggle="tooltip"]').tooltip();
        }
    });


      // Popola il modale con i dati attuali al click del pulsante "Modifica"
    $(document).on('click', '.edit-button', function() {
        const sur_id = $(this).data('id');  // ID della ricerca

        $.ajax({
            url: 'func_pannello.php',
            type: 'POST',
            data: { sur_id: sur_id, action: 'fetch' },
            success: function(response) {
                const data = JSON.parse(response);

                // Popola i campi del modale con i dati ricevuti
                $('#edit_id').val(data.sur_id);
                $('#edit_description').val(data.description);
                $('#edit_panel').val(data.panel);
                $('#edit_sex_target').val(data.sex_target);
                $('#edit_age1_target').val(data.age1_target);
                $('#edit_age2_target').val(data.age2_target);
                $('#edit_goal').val(data.goal);
                $('#edit_end_date').val(data.end_date);
                $('#edit_status').val(data.stato === 'Aperto' ? '0' : '1');
            },
            error: function(xhr, status, error) {
                console.error("Errore durante il recupero dei dati:", error);
            }
        });
    });

    // Gestisce il salvataggio con AJAX
    $('#editForm').submit(function(event) {
        event.preventDefault();
        const formData = $(this).serialize();

        console.log(formData); // Log dei dati serializzati per debug

        $.ajax({
            url: 'func_pannello.php',
            type: 'POST',
            data: formData + '&action=update',
            success: function(response) {
                $('#editModal').modal('hide');
                $('#table_sur').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error("Errore durante l'aggiornamento:", error);
            }
        });
    });
    
});





</script>
