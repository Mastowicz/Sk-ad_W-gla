<?php

    include 'dbconfig.php';

    $klient = $_POST['klient'];
    $towar = $_POST['towar'];
    $ilosc = $_POST['ilosc'];


    $conn = new mysqli($host, $user, $psw, $db);
    if ($conn->connect_error) {
        die("Błąd połączenia z BD: " . $conn->connect_error);
    }

    $zapytanie = "INSERT INTO `zamowienia` (`nr_zamowienia`, `id_klienta`, `id_towaru`, `ilosc`) VALUES (NULL, '$klient', '$towar', '$ilosc')";

    $result = $conn->query($zapytanie) or die("". $conn->error);

    $conn->close();

    echo "<tr><td></td><td>$klient</td><td>$towar</td><td>$ilosc</td><td></td><td></td></tr>"

?>