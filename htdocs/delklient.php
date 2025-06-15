<meta http-equiv="refresh" content="1;url=index.php"/>
<?php

include 'dbconfig.php';
$id = $_GET['id'];

$conn = new mysqli($host, $user, $psw, $db);
if ($conn->connect_error) {
    die("Błąd połączenia z BD: " . $conn->connect_error);
}

$zapytanie = "DELETE FROM klienci WHERE `klienci`.`id` = $id LIMIT 1";
            
$result = $conn->query($zapytanie);

$conn->close();

?>