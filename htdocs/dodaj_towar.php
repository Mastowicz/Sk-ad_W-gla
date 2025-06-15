<?php

    include 'dbconfig.php';

    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "INSERT INTO `towary` (`id`, `nazwa`, `cena`, `opis`) VALUES (NULL, '$nazwa', '$cena', '$opis')";

    $result = $conn->query($zapytanie) or die("". $conn->error);

    $conn->close();

    echo "<tr><td></td><td>$nazwa</td><td>$cena</td><td>$opis</td><td></td><td></td></tr>"

?>