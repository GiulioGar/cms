<!doctype html>
<html lang="it">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    </head>
    <body>
    <div style='margin:auto;margin-bottom:50px;'>
    <h1 style="width:60%;margin: auto;">GLOBIS</h1>
    </div>
    <?php
    $hostname_admin = "localhost"; 
    $database_admin = "millebytesdb";
    $username_admin = "mbuser";
    $password_admin = '$leeple%1598';

    $conn = new mysqli($hostname_admin, $username_admin,$password_admin, $database_admin);

    if ($conn->connect_error){
        die($conn->connect_error);
    }

    $sql="SELECT t_interview_edit.survey_id, t_interview_edit.interview_id, t_respint.uid, t_interview_edit.last_update  FROM t_interview_edit,t_respint where t_interview_edit.project_name='GLB' and t_interview_edit.project_name=t_respint.prj_name and t_interview_edit.interview_id=t_respint.iid and t_interview_edit.editor='glbeditor' and t_interview_edit.survey_id=t_respint.sid;";

    ?>
    <div style="width:100%;">
        <div style="width:60%;margin: auto;">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>SURVEY</th>
                        <th>UID</th>
                        <th>LAST UPDATE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result = $conn -> query($sql)) {
                    while ($row = $result -> fetch_row()) {
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>



    </body>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {

        $('#example').DataTable({
    lengthMenu: [[10, 25, 50, -1],[10, 25, 50, "All"]],
    pageLength: -1,
    order: [[ 2, "asc" ]],
    dom: 'Bfrtip',
    buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data export'
            }
    ]
  });

    });
    </script>
    </html>