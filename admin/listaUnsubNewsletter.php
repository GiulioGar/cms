<!doctype html>
<html lang="it">
    <head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    </head>
    <body>
    <div style='margin:auto;margin-bottom:50px;'>
    <h1 style="width:60%;margin: auto;">UNSUB NEWSLETTER</h1>
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

    $sql="SELECT * from unsub_newsletter";

    ?>
    <div style="width:100%;">
        <div style="width:60%;margin: auto;">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>EMAIL</th>
                        <th>DATA ORA</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result = $conn -> query($sql)) {
                    while ($row = $result -> fetch_row()) {
                        echo "<tr>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {

        $('#example').DataTable();

    });
    </script>
    </html>