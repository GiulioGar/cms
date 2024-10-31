<?php
			if (empty($user_id)) { $user_id = $_POST['user_id']; }
			$emailq = "SELECT first_name, email FROM t_user_info WHERE user_id = '$user_id'";
			$email = mysqli_query($emailq, $admin) or die(mysql_error());
			$email_total = mysql_num_rows($email);
			$row_sql = mysqli_fetch_assoc($email);
			$destinatario = $row_sql['email'];
			$nome_user = $row_sql['first_name'];
		
		$from= "MilleBytes <NO_REPLY@millebytes.com>\n";
		$from.= "MIME-Version: 1.0\n";
		$from.= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
		$from.= "Content-Transfer-Encoding: 7bit\n\n";
        //$from.= "Reply-To: MilleBytes <millebytes@interactive-mr.com> \n";
        //$from.= "X-Mailer: PHP v".phpversion()."\n";
		$to = "$destinatario";
		$mittente_server = "millebytes@{$_SERVER['SERVER_NAME']}";
		$msg =  "<html><body><font face=\"Verdana\" size=\"2\">
            <img src = \"http://www.millebytes.com/img/logo.jpg\"> <br>
			&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren; <br>
			Ciao <strong>$nome_user</strong>, <br>
			&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren;&curren; <br><br>";
		$msg .= $testomessaggio;
		$msg .= "<br /><br />---------------------------- <br><br>

            Per maggiori informazioni sul funzionamento del Club, clicca su uno dei link riportati di seguito:<br>
            
            <a href = \"http://www.millebytes.com/\"><strong>Sito ufficiale del Club Millebytes </strong></a> <br>
            <a href = \"http://www.millebytes.com/members\"><strong>Area Soci</strong></a> <br>
			<a href = \"http://www.millebytes.com/members/show-tickets\"><strong>Area Assistenza</strong></a> <br>
            <a href = \"http://www.interactive-mr.com/\"><strong>Sito ufficiale IMR </strong></a> <br><br><br>

            Per ogni domanda non esitare a contattarci. <br><br>

            <strong>Lo Staff del Club Millebytes - IMR</strong> <br><br>

            <img src = \"http://www.millebytes.com/logo_imr.gif\"> <br><br>

			<a href = \"http://www.millebytes.com/\"><strong>MilleBytes</strong></a> <br>
			</font></body></html>";
            
			mail ($to, $oggettomail, $msg, "From: ".$from, "-f $mittente_server");
?>