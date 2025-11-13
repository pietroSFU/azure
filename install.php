<?php
/**
 * Esegue una query SQL da un file sul database specificato.
 *
 * @param string $host     Host del database (es: 'localhost')
 * @param string $username Nome utente del database
 * @param string $password Password del database
 * @param string $dbname   Nome del database
 * @param string $filePath Percorso al file SQL
 *
 * @return bool|string Ritorna true se la query è stata eseguita con successo, oppure un messaggio di errore
 */
function executeSqlFile($link , $filePath)
{
    // define('DB_SERVER', 'appwebmysql-001-server.mysql.database.azure.com');
    // define('DB_USERNAME', 'ezjhutxtkd');
    // define('DB_PASSWORD', 'gvLmx$OfTknZ$oKM');
    // define('DB_NAME', 'appwebmysql-001-database');

    // /* Attempt to connect to MySQL database */
    // $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    try {
        // Verifica della connessione
        if ($link->connect_error) {
            throw new Exception("Connessione al database fallita: " . $link->connect_error);
        }

        // Controlla se il file SQL esiste
        if (!file_exists($filePath)) {
            throw new Exception("File SQL non trovato: $filePath");
        }

        // Leggi il contenuto del file SQL
        $sqlQuery = file_get_contents($filePath);

        // Esegui la query
        if (!$link->query($sqlQuery)) {
            throw new Exception("Errore nell'esecuzione della query: " . $link->error);
        }
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

require_once "config.php";

$sqldrop = 'sql_drop_table.sql';

// Esegui la funzione
$result_sqldrop = executeSqlFile($link, $sqldrop);
$text_sqldrop = "";
// Mostra il risultato
if ($result_sqldrop === true) {
    $text_sqldrop = "sql_drop_table eseguita con successo.";
} else {
    $text_sqldrop = "Errore sql_drop_table: " . $result_sqldrop;
}

// Percorso al file SQL
$sqlcreate = 'sql_create_table.sql';

// Esegui la funzione
$result_sqlcreate = executeSqlFile($link, $sqlcreate);
$text_sqlcreate = "";
// Mostra il risultato
if ($result_sqlcreate === true) {
    $text_sqlcreate = "sql_create_table eseguita con successo.";
} else {
    $text_sqlcreate = "Errore sql_create_table: " . $result_sqlcreate;
}

// Percorso al file SQL
$sqlinsert = 'sql_insert.sql';
$text_sqlinsert = "";
// Esegui la funzione
$result_sqlinsert = executeSqlFile($link, $sqlinsert);

// Mostra il risultato
if ($result_sqlinsert === true) {
    $text_sqlinsert = "sql_insert eseguita con successo.";
} else {
    $text_sqlinsert = "Errore sql_insert: " . $result_sqlinsert;
}

// Chiudi la connessione
$link->close();

echo $text_sqldrop . " " . $text_sqlcreate . " " . $text_sqlinsert;