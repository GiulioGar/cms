<?php 
require_once('inc_auth.php'); 
require_once('inc_taghead.php');

$cLdat = isset($_REQUEST["dat"]) ? $_REQUEST["dat"] : [];
$nome = isset($_REQUEST["idval"]) ? htmlspecialchars($_REQUEST["idval"]) : '';
$email = isset($_REQUEST["email"]) ? htmlspecialchars($_REQUEST["email"]) : '';
$azione = isset($_REQUEST['azione']) ? $_REQUEST['azione'] : '';

mysqli_select_db($admin, $database_admin);

if ($azione == "ricerca") {
    // Codice per la ricerca
}

require_once('inc_tagbody.php'); 
?>

<div class="content-wrapper">
 <div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-6">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">INSERIRE UID O EMAIL</h6>
        </div>
        <div class="card-body recent-users-sec">
          <form action="user_info.php" method="POST">
            <div class="form-group">
              <textarea class="form-control" name="idval" cols="15" rows="10" placeholder="Inserisci UID"></textarea>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Inserisci Email">
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="card card-primary shadow mb-6">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Selezionare i dati da visualizzare:</h6>
        </div>
        <div class="card-body recent-users-sec">
          <?php
          $checkboxes = [
              "v1" => "Nome",
              "v2" => "E Mail",
              "v3" => "Sesso",
              "v4" => "Età",
              "v5" => "Provincia",
              "v9" => "Regione",
              "v10" => "Area",
              "v6" => "Lavoro",
              "v11" => "CAP",
              "v7" => "Istruzione",
              "v8" => "Status"
          ];

          foreach ($checkboxes as $value => $label) {
              echo "
              <div class='form-check'>
                  <label>
                  <input class='form-check-input' name='dat[]' value='{$value}' type='checkbox' />&nbsp;{$label}
                  </label>
              </div>";
          }
          ?>
          <input type="hidden" name="azione" value="ricerca" />
          <button class="btn btn-primary" name="submit" type="submit" value="CERCA">CERCA</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php 
if ($azione == "ricerca" && (!empty($nome) || !empty($email))) {
    $array = !empty($nome) ? array_map('trim', explode("\n", $nome)) : [];
    $Carr = count($array);

    if ($Carr > 0 || !empty($email)) {
?>

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Utenti trovati:</h6>
      </div>
      <div class="panel-body recent-users-sec">
        <table class="table table-striped table-bordered" style="font-size:12px;">
          <tr>
            <td>ID</td>
            <?php
            $csv = "uid";
            $headers = [
                "v1" => "NOME",
                "v2" => "EMAIL",
                "v3" => "SESSO",
                "v4" => "ETÀ",
                "v5" => "PROVINCIA",
                "v9" => "REGIONE",
                "v10" => "AREA",
                "v6" => "LAVORO",
                "v7" => "TITOLO",
                "v8" => "STATUS",
                "v11" => "CAP"
            ];
            foreach ($headers as $key => $header) {
                if (in_array($key, $cLdat)) {
                    echo "<td>{$header}</td>";
					$csv .= ";{$header}";
                }
            }
			$csv .= "\n";
            echo "<td>&nbsp;</td></tr>";

            if (!empty($nome)) {
                foreach ($array as $row) {
                    $stmt = $admin->prepare("SELECT user_id, first_name, second_name, gender, birth_date, (YEAR(CURDATE()) - YEAR(birth_date)) AS age, work_id, instr_level_id, province_id, mar_status_id, email, code, area, reg FROM t_user_info WHERE user_id = ? ORDER BY user_id");
                    $stmt->bind_param("s", $row);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $infoC = $result->fetch_assoc();
                    $stmt->close();

                    if ($infoC) {
                        $idView = $infoC['user_id'];
                        $nameView = $infoC['first_name'] . " " . $infoC['second_name'];
                        $dataMap = [
                            "v1" => $nameView,
                            "v2" => $infoC['email'],
                            "v3" => $infoC['gender'],
                            "v4" => $infoC['age'],
                            "v5" => $infoC['province_id'],
                            "v9" => $infoC['reg'],
                            "v10" => $infoC['area'],
                            "v6" => $infoC['work_id'],
                            "v7" => $infoC['instr_level_id'],
                            "v8" => $infoC['mar_status_id'],
                            "v11" => $infoC['code']
                        ];

                        echo "<tr><td>{$idView}</td>";
						$csv .= $idView;
                        foreach ($headers as $key => $header) {
                            if (in_array($key, $cLdat)) {
                                echo "<td>{$dataMap[$key]}</td>";
                                $csv .= ";{$dataMap[$key]}";
                            }
                        }
                        echo "
                        <td>
                            <form action=\"user.php\" method=\"get\" target=\"_blank\">
                                <input type=\"hidden\" name=\"user_id\" value=\"{$idView}\" />
                                <input type=\"submit\" value=\"VAI\" style=\"width:100%\" />
                            </form>
                        </td></tr>";
                    }
                }
            }

            if (!empty($email)) {
                $stmt = $admin->prepare("SELECT user_id, first_name, second_name, gender, birth_date, (YEAR(CURDATE()) - YEAR(birth_date)) AS age, work_id, instr_level_id, province_id, mar_status_id, email, code, area, reg FROM t_user_info WHERE email = ? ORDER BY user_id");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $infoC = $result->fetch_assoc();
                $stmt->close();

                if ($infoC) {
                    $idView = $infoC['user_id'];
                    $nameView = $infoC['first_name'] . " " . $infoC['second_name'];
                    $dataMap = [
                        "v1" => $nameView,
                        "v2" => $infoC['email'],
                        "v3" => $infoC['gender'],
                        "v4" => $infoC['age'],
                        "v5" => $infoC['province_id'],
                        "v9" => $infoC['reg'],
                        "v10" => $infoC['area'],
                        "v6" => $infoC['work_id'],
                        "v7" => $infoC['instr_level_id'],
                        "v8" => $infoC['mar_status_id'],
                        "v11" => $infoC['code']
                    ];

                    echo "<tr><td>{$idView}</td>";
					$csv .= $idView;
                    foreach ($headers as $key => $header) {
                        if (in_array($key, $cLdat)) {
                            echo "<td>{$dataMap[$key]}</td>";
                            $csv .= ";{$dataMap[$key]}";
                        }
                    }
                    echo "
                    <td>
                        <form action=\"user.php\" method=\"get\" target=\"_blank\">
                            <input type=\"hidden\" name=\"user_id\" value=\"{$idView}\" />
                            <input type=\"submit\" value=\"VAI\" style=\"width:100%\" />
                        </form>
                    </td></tr>";
                }
            }
            ?>
        </table>
      </div>
    </div>
  </div>
</div>
<?php 
    }
} 
?>

<?php 
if ($azione == "ricerca") { ?>
    <tr><td colspan="9" align="center">
    <form action="csv.php" method="post" target="_blank">
        <input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv); ?>" />
        <input type="hidden" name="filename" value="user_list" />
        <input type="hidden" name="filetype" value="user" />
        <input type="image" value="submit" src="img/CSV.gif" />
    </form>
    </td></tr>
<?php } ?>

</div>
</div>

<?php 
require_once('inc_footer.php'); 
?>
