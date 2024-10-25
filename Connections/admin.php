<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

// 46.37.21.33 
//$leeple%1598


# Configurazione delle variabili di ambiente
$hostname_admin = getenv('DB_HOST') ?: 'localhost';
$database_admin = getenv('DB_NAME') ?: 'millebytesdb';
$username_admin = getenv('DB_USER') ?: 'root';
$password_admin = getenv('DB_PASS') ?: '';

# Connessione al database
$admin = new mysqli($hostname_admin, $username_admin, $password_admin, $database_admin);

# Controllo della connessione
if ($admin->connect_error) {
    die("Connection failed: " . $admin->connect_error);
}

# Funzione per selezionare il database (può essere chiamata nei file successivi)
function selectDatabase($admin, $dbName) {
    if (!mysqli_select_db($admin, $dbName)) {
        die("Database selection failed: " . mysqli_error($admin));
    }
}
?>
