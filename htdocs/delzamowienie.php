<meta http-equiv="refresh" content="1;url=index.php"/>
<?php

include 'dbconfig.php';
$zal = $_GET['nr_zamowienia'];

$conn = new mysqli($host, $user, $psw, $db);
if ($conn->connect_error) {
    die("Błąd połączenia z BD: " . $conn->connect_error);
}

$zapytanie = "DELETE FROM zamowienia WHERE zamowienia.nr_zamowienia = $zal LIMIT 1";

$result = $conn->query($zapytanie);

$conn->close();

?>