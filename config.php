<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', $_ENV['AZURE_MYSQL_HOST']);
define('DB_USERNAME', $_ENV['AZURE_MYSQL_USERNAME']);
define('DB_PASSWORD', $_ENV['AZURE_MYSQL_PASSWORD']);
define('DB_NAME', $_ENV['AZURE_MYSQL_DBNAME']);

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>