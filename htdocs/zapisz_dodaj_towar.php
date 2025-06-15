<meta http-equiv="refresh" content="1;url=index.php"/>

<?php

    include 'dbconfig.php';

    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $id= $_POST['id'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "UPDATE `towary` SET `nazwa` = '$nazwa', `cena` = '$cena', `opis` = '$opis' WHERE `towary`.`id` = $id;";

    $result = $conn->query($zapytanie);

    $conn->close();
?>